<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class CalculateController extends Controller
{
  public function index(Request $request)
  {
    $num1 = $num2 = 0;
    $result = $num1 + $num2;
    return view('calculate', ['result'=>$result]);
  }

  public function calculate(Request $request)
  {
    $num1 = $num2 = 0;
    $sym = null;

    $num1 = $request->input('firstNumber') ? $request->input('firstNumber') : $num1;
    $num2 = $request->input('secondNumber') ? $request->input('secondNumber') : $num2;
    $sym = $request->input('calculateSymbol');

    switch ($sym) {
      case '+':
        $result = ($num1 + $num2) % 7;
        break;
      case '-':
        $result = ($num1 - $num2) % 7;
        break;
      case 'x':
        $result = ($num1 * $num2) % 7;
        break;
      default:
        $result = $num1;
    }
    
    return response()->json(['result'=>$result]);
  }

}
