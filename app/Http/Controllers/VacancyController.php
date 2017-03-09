<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Country;
use App\Model\Currency;
use App\Model\EducationType;
use App\Model\Employment;
use App\Model\ExperienceType;
use App\Model\Profession;
use App\Model\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * @param Request        $request
	 * @param Category       $category
	 * @param Country        $country
	 * @param EducationType  $educationType
	 * @param Employment     $employment
	 * @param Currency       $currency
	 * @param ExperienceType $experienceType
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function addNew(Request $request, Category $category, Country $country, EducationType $educationType, Employment $employment, Currency $currency, ExperienceType $experienceType)
	{
		$this->data['vacancy'] = new Vacancy();
		$this->data['categories'] = $category->getForm();
		$this->data['countries'] = $country->getForm();
		$this->data['education_types'] = $educationType->getForm();
		$this->data['employments'] = $employment->getForm();
		$this->data['currencies'] = $currency->getForm();
		$this->data['experience_types'] = $experienceType->getForm();
		return view('user.company.addvacancy', $this->data);
	}

	/**
	 * @param Request    $request
	 * @param Profession $profession
	 */

	public function getProfession(Request $request,Profession $profession)
	{
		if ($request->ajax()) {
			$this->data['professions'] = $profession->getForm($request->category_id);

			echo view('vacancy.profession', $this->data);
		}
	}

	/**
	 * @param Request $request
	 */

	public function createNew(Request $request)
	{

	}

	public function preview(Request $request)
	{
		if ($request->ajax())
		{
			$this->data['vacancy'] = $request;
			$this->data['country'] = Country::whereCountryId($request->country_id)->firstOrFail()->name;
			$this->data['category'] = Category::whereCategoryId($request->category_id)->firstOrFail()->name;
			$this->data['profession'] = Profession::whereProfessionId($request->profession_id)->firstOrFail()->name;
			$this->data['currency'] = Currency::whereCurrencyId($request->currency_id)->firstOrFail()->name;
			$this->data['experience_type'] = ExperienceType::whereExperienceTypeId($request->exepience_type_id)->firstOrFail()->name;
			$this->data['education_type'] = EducationType::whereEducationTypeId($request->education_type_id)->firstOrFail()->name;
			$this->data['employment'] = Employment::whereEmploymentId($request->employment_id)->firstOrFail()->name;
			$this->data['user'] = $request->user();

			echo view('vacancy.preview', $this->data);
		}
	}
}
