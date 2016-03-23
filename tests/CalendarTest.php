<?php
namespace ML_Express\Calendar\Tests;

require_once __DIR__ . '/../allIncl.php';

use ML_Express\Calendar\Day;
use ML_Express\Calendar\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider yearProvider
	 */
	public function testYear($year, $expected)
	{
		$actual = Calendar::year($year);
		$this->assertEquals($expected, $actual);
	}

	public function yearProvider()
	{
		return array(
			[null, Calendar::span(Day::FirstOfThisYear(), Day::FirstOfThisYear(1))],
			[2016, Calendar::span('2016-01-01', '2017-01-01')]
		);
	}

	/**
	 * @dataProvider monthProvider
	 */
	public function testMonth($month, $year, $expected)
	{
		$actual = Calendar::month($month, $year);
		$this->assertEquals($expected, $actual);
	}

	public function monthProvider()
	{
		$year = date('Y');
		return array(
			[null, null, Calendar::span(Day::FirstOfThisMonth(), Day::FirstOfThisMonth(1))],
			[4, null, Calendar::span("$year-04-01", "$year-05-01")],
			[2, 2016, Calendar::span("2016-02-01", "2016-03-01")]
		);
	}

	/**
	 * @dataProvider monthsProvider
	 */
	public function testMonths($delta, $month, $year, $expected)
	{
		$actual = Calendar::months($delta, $month, $year);
		$this->assertEquals($expected, $actual);
	}

	public function monthsProvider()
	{
		return array(
			[+0, null, null, Calendar::span(Day::FirstOfThisMonth(), Day::FirstOfThisMonth(1))],
			[-2, null, null, Calendar::span(Day::FirstOfThisMonth(-2), Day::FirstOfThisMonth(1))],
			[+1, null, null, Calendar::span(Day::FirstOfThisMonth(), Day::FirstOfThisMonth(2))]
		);
	}

	/**
	 * @dataProvider buildArrayProvider
	 */
	public function testBuildArray($from, $till, $firstWeekday, $expected)
	{
		$actual = Calendar::span($from, $till)->setFirstWeekday($firstWeekday)->buildArray();
		$this->assertSame($expected, $actual);
	}

	public function buildArrayProvider()
	{
		return array(
			array(new Day('2015-12-29'), new Day('2016-02-02'), 0, array(
				'weekdays' => array(
					'mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu',
					'fri' => 'Fri', 'sat' => 'Sat', 'sun' => 'Sun'
				),
				'years' => array(
					array(
						'time' => '2015',
						'label' => '2015',
						'months' => array(
							array(
								'time' => '2015-12',
								'label' => 'December',
								'weeks' => array(
									array(
										'time' => '2015-W53',
										'label' => '53',
										'days' => array(
											array(
												'time' => '2015-12-29',
												'label' => '29'
											),
											array(
												'time' => '2015-12-30',
												'label' => '30'
											),
											array(
												'time' => '2015-12-31',
												'label' => '31'
											),
										)
									)
								)
							)
						)
					),
					array(
						'time' => '2016',
						'label' => '2016',
						'months' => array(
							array(
								'time' => '2016-01',
								'label' => 'January',
								'weeks' => array(
									array(
										'time' => '2015-W53',
										'label' => '53',
										'days' => array(
											array(
												'time' => '2016-01-01',
												'label' => '1'
											),
											array(
												'time' => '2016-01-02',
												'label' => '2'
											),
											array(
												'time' => '2016-01-03',
												'label' => '3'
											),
										)
									),
									array(
										'time' => '2016-W01',
										'label' => '01',
										'days' => array(
											array(
												'time' => '2016-01-04',
												'label' => '4'
											),
											array(
												'time' => '2016-01-05',
												'label' => '5'
											),
											array(
												'time' => '2016-01-06',
												'label' => '6'
											),
											array(
												'time' => '2016-01-07',
												'label' => '7'
											),
											array(
												'time' => '2016-01-08',
												'label' => '8'
											),
											array(
												'time' => '2016-01-09',
												'label' => '9'
											),
											array(
												'time' => '2016-01-10',
												'label' => '10'
											),
										)
									),
									array(
										'time' => '2016-W02',
										'label' => '02',
										'days' => array(
											array(
												'time' => '2016-01-11',
												'label' => '11'
											),
											array(
												'time' => '2016-01-12',
												'label' => '12'
											),
											array(
												'time' => '2016-01-13',
												'label' => '13'
											),
											array(
												'time' => '2016-01-14',
												'label' => '14'
											),
											array(
												'time' => '2016-01-15',
												'label' => '15'
											),
											array(
												'time' => '2016-01-16',
												'label' => '16'
											),
											array(
												'time' => '2016-01-17',
												'label' => '17'
											),
										)
									),
									array(
										'time' => '2016-W03',
										'label' => '03',
										'days' => array(
											array(
												'time' => '2016-01-18',
												'label' => '18'
											),
											array(
												'time' => '2016-01-19',
												'label' => '19'
											),
											array(
												'time' => '2016-01-20',
												'label' => '20'
											),
											array(
												'time' => '2016-01-21',
												'label' => '21'
											),
											array(
												'time' => '2016-01-22',
												'label' => '22'
											),
											array(
												'time' => '2016-01-23',
												'label' => '23'
											),
											array(
												'time' => '2016-01-24',
												'label' => '24'
											),
										)
									),
									array(
										'time' => '2016-W04',
										'label' => '04',
										'days' => array(
											array(
												'time' => '2016-01-25',
												'label' => '25'
											),
											array(
												'time' => '2016-01-26',
												'label' => '26'
											),
											array(
												'time' => '2016-01-27',
												'label' => '27'
											),
											array(
												'time' => '2016-01-28',
												'label' => '28'
											),
											array(
												'time' => '2016-01-29',
												'label' => '29'
											),
											array(
												'time' => '2016-01-30',
												'label' => '30'
											),
											array(
												'time' => '2016-01-31',
												'label' => '31'
											),
										)
									)
								)
							),
							array(
								'time' => '2016-02',
								'label' => 'February',
								'weeks' => array(
									array(
										'time' => '2016-W05',
										'label' => '05',
										'days' => array(
											array(
												'time' => '2016-02-01',
												'label' => '1'
											)
										)
									)
								)
							)
						)
					)
				)
			)),
		);
	}
}