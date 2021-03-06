<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Country;
use App\Model\EducationType;
use App\Model\Employment;
use App\Model\ExperienceType;
use App\Model\Profession;
use App\Model\Vacancy;
use Illuminate\Http\Request;

class VacancyFilterController extends Controller
{
	/**
	 * @param Request        $request
	 * @param Category       $category
	 * @param Profession     $profession
	 * @param Country        $country
	 * @param Employment     $employment
	 * @param ExperienceType $experienceType
	 * @param EducationType  $educationType
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(
		Request $request,
		Category $category,
		Profession $profession,
		Country $country,
		Employment $employment,
		ExperienceType $experienceType,
		EducationType $educationType
	) {
		$this->data['categories'] = $category->getForm();
		$this->data['categories']['-1'] = 'Все';

		$this->data['professions'] = $profession->getFormAll();
		$this->data['professions']['-1'] = 'Любая';

		$this->data['countries'] = $country->getForm();
		$this->data['countries']['-1'] = 'Любая';

		$this->data['employments'] = $employment->getForm();
		$this->data['employments']['-1'] = 'Любая';

		$this->data['education_types'] = $educationType->getForm();
		$this->data['education_types']['-1'] = 'Любое';

		$this->data['experience_types'] = $experienceType->getForm();
		$this->data['experience_types']['-1'] = 'Любой';


		return view('filterpage.vacancyindex', $this->data);
	}

	/**
	 * @param Request $request
	 * @param Vacancy $vacancy
	 */

	public function get(Request $request, Vacancy $vacancy)
	{
		if ($request->ajax()) {
			if ($request->category_id != -1) {
				$vacancy = $vacancy->whereCategoryId($request->category_id);
			}
			if ($request->profession_id != -1) {
				$vacancy = $vacancy->whereProfessionId($request->profession_id);
			}
			if ($request->employment_id != -1) {
				$vacancy = $vacancy->whereEmploymentId($request->employment_id);
			}
			if ($request->country_id != -1) {
				$vacancy = $vacancy->whereCountryId($request->country_id);
			}
			if ($request->experience_type_id != -1) {
				$vacancy = $vacancy->whereExperienceTypeId($request->experience_type_id);
			}
			if ($request->education_type_id != -1) {
				$vacancy = $vacancy->whereEducationTypeId($request->education_type_id);
			}
			$vacancy = $vacancy->orderBy('updated_at', 'desc')->get();

			$this->data['vacancies'] = $vacancy;

			$vips = $vacancy->filter(
				function ($item) {
					return $item->isVip() != false;
				}
			);
			$this->data['vips'] = $vips;
			if ($vips->isNotEmpty())
				$this->data['vips'] = $vips->random($vips->count() >= 3 ? 3 : $vips->count());

			echo view('filterpage.vacancylist', $this->data);
		}
	}

	/**
	 * @param Request    $request
	 * @param Profession $profession
	 */

	public function getProfession(Request $request, Profession $profession)
	{
		if ($request->ajax()) {
			if ($request->category_id == -1) {
				$this->data['professions'] = $profession->getFormAll();
			}
			else {
				$this->data['professions'] = $profession->getForm($request->category_id);
			}
			$this->data['professions']['-1'] = 'Любая';
			echo view('vacancy.profession', $this->data);
		}
	}
}
