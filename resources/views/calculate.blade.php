@extends('layouts.app')
{!! Html::style('css/calculate.css') !!}
@section('content')
    <div class="container" ng-app="calculateApp" ng-controller="calculateController">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Calculator</div>

                    <div class="panel-body">
{{--                        {!! Form::open(['url'=>'api/calculateAll','class'=>'form', 'ng-submit'=>'calculate(); return false;']) !!}--}}
                        {{--{!! Form::open(['class'=>'form', 'ng-submit'=>'calculate()']) !!}--}}
                        {{--<form action="api/calculateAll" class="form" method="POST">--}}
                        <form ng-submit="calculate()" class="form" method="POST">
                            <div class="form-group">
                                <input class='result' id='result' readonly value="<% calculateResult %>" />
                                <input type="hidden" name="_token" id="csrf-token" ng-model="calToken" value="{{ Session::token() }}" />
                                {{--{!! Form::token(['ng-model'=>'calToken']) !!}--}}
                            </div>
                            <div class="form-group">
                                {!! Form::button('1',['class'=>'calculate_input', 'ng-click'=>'addNumber("1")', 'value'=>'1']) !!}
                                {!! Form::button('2',['class'=>'calculate_input', 'ng-click'=>'addNumber("2")', 'value'=>'2']) !!}
                                {!! Form::button('3',['class'=>'calculate_input', 'ng-click'=>'addNumber("3")', 'value'=>'3']) !!}
                                {!! Form::button('x',['class'=>'calculate_input', 'ng-click'=>'calculateSymbol("x")']) !!}
{{--                                {!! Form::text('content',null,['class'=>'calculate_input first_number', 'hidden'=>'hidden', 'id'=>'first_number', 'ng-model'=>'calculateNumber1']) !!}--}}
                                <input type="text" class="calculate_input first_number" id="first_number" hidden ng-model="calculateNumber1" name="firstNumber"/>
                            </div>
                            <div class="form-group">
                                {!! Form::button('4',['class'=>'calculate_input', 'ng-click'=>'addNumber("4")', 'value'=>'4']) !!}
                                {!! Form::button('5',['class'=>'calculate_input', 'ng-click'=>'addNumber("5")', 'value'=>'5']) !!}
                                {!! Form::button('6',['class'=>'calculate_input', 'ng-click'=>'addNumber("6")', 'value'=>'6']) !!}
                                {!! Form::button('-',['class'=>'calculate_input', 'ng-click'=>'calculateSymbol("-")']) !!}
{{--                                {!! Form::text('content',null,['class'=>'calculate_input second_number', 'hidden'=>'hidden', 'id'=>'second_number']) !!}--}}
                                <input type="text" class="calculate_input calSymbol" id="calSymbol" hidden ng-model="calculateSymbolText" name="calculateSymbol"/>
                                <input type="text" class="calculate_input second_number" id="second_number" hidden ng-model="calculateNumber2" name="secondNumber"/>
                                <input type="text" class="calculate_input done" id="done" hidden ng-model="calculateDone" name="calculateDone"/>
                            </div>
                            <div class="form-group">
                                {!! Form::button('Del',['class'=>'calculate_input', 'ng-click'=>'delNumber()']) !!}
                                {!! Form::button('0',['class'=>'calculate_input', 'ng-click'=>'addNumber("0")', 'value'=>'0']) !!}
                                {!! Form::submit('=',['class'=>'calculate_input']) !!}
                                {!! Form::button('+',['class'=>'calculate_input', 'ng-click'=>'calculateSymbol("+")']) !!}
                            </div>
                            {{--<input type="submit" onsubmit="calculate(); return false;" value="OK"/>--}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
