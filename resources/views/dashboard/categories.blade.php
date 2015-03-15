@extends('layouts.left')

@section('title')
{{ @trans('prompts.categories') }}
@stop

@section('buttons')
	@include('dashboard/blocks/buttons')
@stop

@section('sidebar')
<?php /* ?>
<div>Left side bar of Categories</div>


<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
  <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>

  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
</ul>


<div class="dropdown">
</div>


	<button id="dropdownMenu3" class="btn btn-default dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button">Dropdown
		<span class="caret"></span>
	</button>






<ul>
	<li id="dropdownMenu3" class="dropdown-toggle" data-toggle="dropdown" type="button"><span class="caret">FFFFFFF</span>

	<ul class="dropdown-menu" aria-labelledby="dropdownMenu3" role="menu">
		<li role="presentation"><a href="#" tabindex="-1" role="menuitem">Regular link</a></li>
		<li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
		<li role="presentation"><a href="#" tabindex="-1" role="menuitem">Another link</a></li>
	</ul>

	</li>
</ul>





<div class="btn-group-vertical" role="group" aria-label="...">
  <button type="button" class="btn btn-default">1</button>
  <button type="button" class="btn btn-default">2</button>

  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      Dropdown
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#">Dropdown link</a></li>
      <li><a href="#">Dropdown link</a></li>
    </ul>
  </div>
</div>










<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle"data-parent="#acc0"data-toggle="collapse" href="#acc1">Первый пункт</a>
</div>

<div class="accordion-body collapse" id="acc1">
<div class="accordion-inner">
<ul class="nav nav-list">
<li><a href="#/list/50482024">Подпункт 1</a></li>
<li><a href="#/list/50476019">Подпункт 2</a></li>
<li><a href="#/list/50460019">Подпункт 3</a></li>
<li><a href="#/list/50466014">Подпункт 4</a></li>
<li><a href="#/list/50482023">Подпункт 5</a></li>
</ul>
</div>
</div>
</div>

<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle"data-parent="#acc0"data-toggle="collapse" href="#/list/50482024"></i>Второй пункт</a>
</div>
</div>
</div>

<?php */ ?>











    <div class="panel-group" id="accordion">



        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. What is HTML?</a>
                </h4>
            </div>

            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>HTML stands for HyperText Markup Language. HTML is the main markup language for describing the structure of Web pages. <a href="http://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>






        <div class="panel-group" id="accordion1">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo_1">2. What is Bootstrap?</a>
                </h4>
            </div>
            <div id="collapseTwo_1" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Bootstrap is a powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo_2">Noe a-reference</h4>
            </div>
            <div id="collapseTwo_2" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Bootstrap is a powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>

		</div>





                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2. What is Bootstrap?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Bootstrap is a powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. What is CSS?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="http://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>



    </div>


@stop

@section('content')
<div>Categories content</div>
@stop
