<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    private $insurance_fee_tree = [
        20 => [
            'step_value' => 260000,
            'from' => 250000,
            'to' => 270000,
            'health' => 13182,
            'pension' => 23790,
        ],
        21 => [
            'step_value' => 280000,
            'from' => 270000,
            'to' => 290000,
            'health' => 14196,
            'pension' => 25620,
        ],
        22 => [
            'step_value' => 300000,
            'from' => 290000,
            'to' => 310000,
            'health' => 15210,
            'pension' => 27450,
        ],
        23 => [
            'step_value' => 320000,
            'from' => 310000,
            'to' => 330000,
            'health' => 16224,
            'pension' => 29280,
        ],
        24 => [
            'step_value' => 340000,
            'from' => 330000,
            'to' => 350000,
            'health' => 17238,
            'pension' => 31110,
        ],
        25 => [
            'step_value' => 360000,
            'from' => 350000,
            'to' => 370000,
            'health' => 18252,
            'pension' => 32940,
        ],
        26 => [
            'step_value' => 380000,
            'from' => 370000,
            'to' => 395000,
            'health' => 19266,
            'pension' => 34770,
        ],
        27 => [
            'step_value' => 410000,
            'from' => 395000,
            'to' => 425000,
            'health' => 20787,
            'pension' => 37515,
        ],
        28 => [
            'step_value' => 440000,
            'from' => 425000,
            'to' => 455000,
            'health' => 22308,
            'pension' => 40260,
        ],
        29 => [
            'step_value' => 470000,
            'from' => 455000,
            'to' => 485000,
            'health' => 23829,
            'pension' => 43005,
        ],
        30 => [
            'step_value' => 500000,
            'from' => 485000,
            'to' => 515000,
            'health' => 25350,
            'pension' => 45750,
        ],
        31 => [
            'step_value' => 530000,
            'from' => 515000,
            'to' => 545000,
            'health' => 26871,
            'pension' => 48495,
        ],
        32 => [
            'step_value' => 560000,
            'from' => 545000,
            'to' => 575000,
            'health' => 28392,
            'pension' => 51240,
        ],
    ];

    public function index()
    {
        return view('input');
    }

    public function result(Request $request)
    {
        $sales = $request->input('sales');
        $share = $sales * 0.8;

        foreach ($this->insurance_fee_tree as $grade => $values) {
            $insurance_total = ($values['health'] + $values['pension']) * 2;
            $salary = $share - $insurance_total;

            if ($salary > $values['to']) {
                $last_grade = $grade;
            }
            if ($values['from'] <= $salary && $salary < $values['to']) {
                $in_range = true;
                $max_salary = $values['to'] - 1;
                $data['sales'] = $sales;
                $data['salary'] = $max_salary;
                $data['after_tax'] = $max_salary - ($values['health'] + $values['pension']);
                $data['insurance_total'] = $insurance_total;
                $data['total'] = $max_salary + $insurance_total;
            }
        }

        if (!isset($in_range)) {
            $values = $this->insurance_fee_tree[$last_grade];
            $insurance_total = ($values['health'] + $values['pension']) * 2;
            $salary = $share - $insurance_total;
            $max_salary = $values['to'] - 1;

            $data['sales'] = $sales;
            $data['salary'] = $max_salary;
            $data['after_tax'] = $max_salary - ($values['health'] + $values['pension']);
            $data['insurance_total'] = $insurance_total;
            $data['total'] = $max_salary + $insurance_total;
        }


        return view('result', $data);
    }


    private function example(int $aaa)
    {
        if ($aaa === 0) {
            dump('0でした');
        } elseif ($aaa === 1) {
            dump('1でした');
        }
    }
}
