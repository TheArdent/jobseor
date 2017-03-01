<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$this->data['user'] = $request->user();

		if ($request->user()->role_id == 2)
		{
			$this->data['company'] = $request->user()->company;
			dd($this->data);
			return view('user.company.home', $this->data);
		}

		if ($request->user()->role_id == 3)
		{
			$this->data['applicant'] = $request->user()->applicant;
			return view('user.applicant.home', $this->data);
		}

		return redirect('/admin');
	}
}
