<?php

// ------------------- general
$title = "Scholen";
$titleHs = "Hogescholen";
$titleUni = "Universiteiten";

$file_hs = fopen("lijst_hogescholen.csv", "r");
$file_uni = fopen("lijst_universiteiten.csv", "r");
$arrdump_hs = fgetcsv($file_hs)[0];
$arrdump_uni = fgetcsv($file_uni)[0];
fclose($file_hs);
fclose($file_uni);

$table_head = [];
$table_head_length = 8;


// ------------------- hogescholen

$schools_hs = explode(";", $arrdump_hs);
$row_length = 21;
$column_length = 9;
$school_hs = [];
$all_schools_hs = [];

//put hs data in array
for ($j=0; $j < $column_length; $j++) {
    for ($i=0; $i < $row_length; $i++) {
        if($i == 3 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 12 || $i == 14 || $i == 15) {
            if(count($table_head) < $table_head_length) {
                array_push($table_head, $schools_hs[$i]);
            }
            $school_hs[$i] = $schools_hs[$row_length * ($j+1) + $i];
        }
    }
    $all_schools_hs[$j] = $school_hs;
}

//set proper key-value pairs
for ($i=0; $i < count($all_schools_hs); $i++) {
    $all_schools_hs[$i] = array_combine($table_head, $all_schools_hs[$i]);
    $all_schools_hs[$i]['straat'] = $all_schools_hs[$i]['straat'] . " " . $all_schools_hs[$i]['huisnummer'];
    unset($all_schools_hs[$i]['huisnummer']);
}


// ------------------- universiteiten

$title_uni = "Universiteiten";
$schools_uni = explode(";", $arrdump_uni);
$row_length = 21;
$column_length = 3;
$school_uni = [];
$all_schools_uni = [];

//put uni data in array
for ($j=0; $j < $column_length; $j++) {
    for ($i=0; $i < $row_length; $i++) {
        if($i == 3 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 12 || $i == 14 || $i == 15) {
            if(count($table_head) < $table_head_length) {
                array_push($table_head, $schools_uni[$i]);
            }
            $school_uni[$i] = $schools_uni[$row_length * ($j+1) + $i];
        }
    }
    $all_schools_uni[$j] = $school_uni;
}

//set proper key-value pairs
for ($i=0; $i < count($all_schools_uni); $i++) {
    $all_schools_uni[$i] = array_combine($table_head, $all_schools_uni[$i]);
    $all_schools_uni[$i]['straat'] = $all_schools_uni[$i]['straat'] . " " . $all_schools_uni[$i]['huisnummer'];
    unset($all_schools_uni[$i]['huisnummer']);
}

unset($table_head[2]);

?>

  @extends('layouts.app') @section('content')
  <div class="container">
    <div class="row contact_page">
      <h2 class="page_title">Contact</h2>



      <div class="success"></div>
      <script>
        formajax("contactform", "gocontact");
      </script>


      <div class="contact_div">
        {!! Form::open(['route' => 'contact','id'=>'contactform']) !!} {{ Form::label('subject','ONDERWERP')}} {{ Form::text('subject',old('subject'),array('class' =>'form-control ','requireds'=>'','maxlength'=>'255'))}} {{ Form::label('email','JOUW E-MAIL')}}
        {{ Form::text('email',old('email'),array('class' =>'form-control ','requireds'=>'','maxlength'=>'255'))}} {{ Form::label('message','BERICHT',["class" => 'form-space'])}} {{ Form::textarea('message',old('message'),array('class' =>'form-control','requireds'=>''))}}
        {{ Form::submit('VERZENDEN',array('class' =>'btn btn-success gocontact btn-lg bottom_buttom btn-block', 'style'=>'margin-top:20px'))}}
        <center><i class="fa fa-spinner fa-spin fa-2x loading hidden"></i></center>
        {!! Form::close() !!}

      </div>


      <h2 class="page_title">Contacteer een school</h2>

      <!-- UNIVERSITEITEN -->

      <h3 id="uni_btn">Universiteiten</h3>

      <div id="uni_div">
        <?php foreach ($all_schools_uni as $school): ?>
          <div class="school_container school-div">
            <h3><?= $school['naam'] ?> <small>(<?= $school['gemeente'] ?>)</small></h3>
            <p>
              <?= $school['straat'] ?>
                <br>
                <?= $school['postcode'] ?>
                  <?= $school['gemeente'] ?>
            </p>
            <?php if($school['telefoon'] != ''): ?>
              <p>
                <b>Telefoon:</b>
                <?= $school['telefoon'] ?>
              </p>
              <?php endif ?>
                <?php if($school['e-mail'] != ''): ?>
                  <p>
                    <b>E-mail:</b>
                    <?= $school['e-mail'] ?>
                  </p>
                  <?php endif ?>
                    <p>
                      <a href="<?= $school['url'] ?>" class="school_link">Bezoek de website!</a>
                      <br>
                    </p>
          </div>
          <?php endforeach ?>
      </div>

      <!-- HOGESCHOLEN -->

      <h3 id="hs_btn">Hoge Scholen</h3>

      <div id="hs_div">
        <?php foreach ($all_schools_hs as $school): ?>
          <div class="school_container school-div">
            <h3><?= $school['naam'] ?> <small>(<?= $school['gemeente'] ?>)</small></h3>
            <p>
              <?= $school['straat'] ?>
                <br>
                <?= $school['postcode'] ?>
                  <?= $school['gemeente'] ?>
            </p>
            <?php if($school['telefoon'] != ''): ?>
              <p>
                <b>Telefoon:</b>
                <?= $school['telefoon'] ?>
              </p>
              <?php endif ?>
                <?php if($school['e-mail'] != ''): ?>
                  <p>
                    <b>E-mail:</b>
                    <?= $school['e-mail'] ?>
                  </p>
                  <?php endif ?>
                    <p>
                      <a href="<?= $school['url'] ?>" class="school_link">Bezoek de website!</a>
                      <br>
                    </p>
          </div>
          <?php endforeach ?>
      </div>

    </div>
  </div>
  @endsection