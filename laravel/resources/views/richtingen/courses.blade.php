<?php

session_start();

// if user clicks on btn set correct filename
if (isset($_GET['opleiding_type'])) {
    $_SESSION['opleiding_type'] = $_GET['opleiding_type'];
}
elseif (isset($_SESSION['opleiding_type'])) {
    $_SESSION['opleiding_type'] = $_SESSION['opleiding_type'];
}
else {
    if(!isset($_GET['opleiding_type'])) {
        $_SESSION['opleiding_type'] = ["PB"];
    }
}

//if search term
if(isset($_GET['search']) && $_GET['search'] !== '') {
    $search_term = $_GET['search'];
    $_SESSION['search'] = $_GET['search'];
}
else {
    $_SESSION['search'] = null;
}

$arr_school_name = [];
$arr_school_location = [];

if (!empty($_SESSION['opleiding_type'])) {
    foreach ($_SESSION['opleiding_type'] as $opleiding) {
        $filename = "opleidingen" . $opleiding . ".html";
        
        $html_contents = File::get($filename);
        
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($html_contents);
        
        libxml_clear_errors();
        $xpath = new DOMXPath($doc);
        $data = $xpath->query("//td");
        $data_length = $data->length;
        
        //insert data into array
        for ($i=0; $i < $data_length; $i++) {
            if ($i % 2 == 0) {
                $item = $data->item($i)->nodeValue;
                array_push($arr_school_name, $item);
            }
            else {
                $item = $data->item($i)->nodeValue;
                array_push($arr_school_location, $item);
            }
        }
    }
}

//school names
if(isset($_GET['school_naam'])) {
    $_SESSION['school_naam'] = $_GET['school_naam'];
}
else {
    $_SESSION['school_naam'] = null;
}

//checklist class strings
$opleiding_types_string = implode(", ", $_SESSION['opleiding_type']);
if(isset($_GET['school_naam'])) {
    $school_names_string = implode(", ", $_SESSION['school_naam']);
}
else {
    $school_names_string = "";
}

//for search bar
$opleiding_types = ["PB", "AB", "M"];
$alle_opleidingen = [];

foreach ($opleiding_types as $opleiding) {
    $filename = "opleidingen" . $opleiding . ".html";
    
    $html_contents = File::get($filename);
    
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($html_contents);
    
    libxml_clear_errors();
    $xpath = new DOMXPath($doc);
    $data = $xpath->query("//td");
    $data_length = $data->length;
    
    //insert data into array
    for ($i=0; $i < $data_length; $i++) {
        if ($i % 2 == 0) {
            $item = $data->item($i)->nodeValue;
            array_push($alle_opleidingen, $item);
        }
        else {
            $item = $data->item($i)->nodeValue;
            array_push($alle_opleidingen, $item);
        }
    }
}

$search_data = implode(", ", array_unique($alle_opleidingen));

?>


  @extends('layouts.app') @section('content')

  <div class="container">
    <div class="row">
      <h1 class="page_title">Opleidingen</h1>
    </div>

    <div class="row">
      <div class="refine_search">
        <form class="opleiding_form">
          <h3>Specifiek Zoeken</h3>

          <h4>Kernwoorden</h4>

          <div class="search_form">
            <?php if (isset($_SESSION['search'])): ?>
              <?php $search_value = $_SESSION['search']; ?>
                <?php endif ?>
                  <input type="text" class="awesomplete" name="search" id="search" data-list="{{$search_data}}" <?php echo (isset($search_value)) ? "value='$search_value'" : "" ?> >
          </div>

          <h4>Type Opleiding</h4>

          <input type="checkbox" name="opleiding_type[]" value="PB" id="PB" <?php echo (strpos($opleiding_types_string, "PB") !==false ? 'checked' : '');?> >
          <label for="PB" class="butt">Professionele Bachelor</label>

          <input type="checkbox" name="opleiding_type[]" value="AB" id="AB" <?php echo (strpos($opleiding_types_string, "AB") !==false ? 'checked' : '');?> >
          <label for="AB" class="butt">Academische Bachelor</label>

          <input type="checkbox" name="opleiding_type[]" value="M" id="M" <?php echo (strpos($opleiding_types_string, "M") !==false ? 'checked' : '');?> >
          <label for="M" class="butt">Master</label>

          <br>

          <h4>School</h4>

          <input type="checkbox" name="school_naam[]" value="Universiteit" id="Universiteit" <?php echo (strpos($school_names_string, "Universiteit") !==false ? 'checked' : '');?> >
          <label for="Universiteit" class="butt">Universiteit Antwerpen</label>

          <input type="checkbox" name="school_naam[]" value="Artesis" id="Artesis" <?php echo (strpos($school_names_string, "Artesis") !==false ? 'checked' : '');?> >
          <label for="Artesis" class="butt">Artesis Plantijn </label>

          <input type="checkbox" name="school_naam[]" value="Karel" id="Karel" <?php echo (strpos($school_names_string, "Karel") !==false ? 'checked' : '');?> >
          <label for="Karel" class="butt">Karel De Grote </label>

          <input type="checkbox" name="school_naam[]" value="Thomas" id="Thomas" <?php echo (strpos($school_names_string, "Thomas") !==false ? 'checked' : '');?> >
          <label for="Thomas" class="butt">Thomas More </label>

          <br>

          <button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> ZOEK </button>

          <div class="link_div">
            <a href="https://www.onderwijskiezer.be/v2/index.php" target="_blank" class="onderwijs_link">Meer weten? Ga naar de Onderwijs Kiezer.</a>
          </div>
        </form>
        <br>
      </div>
    </div>

    <div class="row">
      <div class="school-list">
        <!-- LIST (large screen) -->
        <table class="large_screen">
          <?php for ($i=0; $i < count($arr_school_name); $i++): ?>
            <?php if (isset($search_term)): ?>
              <?php if (stripos($arr_school_name[$i], $search_term) !== false): ?>
                <?php if (!empty($_SESSION['school_naam'])): ?>
                  <?php foreach ($_SESSION['school_naam'] as $school_naam): ?>
                    <?php if (strpos($arr_school_location[$i], $school_naam) !== false): ?>
                      <tr>
                        <td>
                          <?= $arr_school_name[$i] ?>
                        </td>
                        <td>
                          <?= $arr_school_location[$i] ?>
                        </td>
                      </tr>
                      <?php endif ?>
                        <?php endforeach; ?>
                          <?php else: ?>
                            <tr>
                              <td>
                                <?= $arr_school_name[$i] ?>
                              </td>
                              <td>
                                <?= $arr_school_location[$i] ?>
                              </td>
                            </tr>
                            <?php endif ?>
                              <?php endif ?>
                                <?php elseif (!empty($_SESSION['school_naam'])): ?>
                                  <?php foreach ($_SESSION['school_naam'] as $school_naam): ?>
                                    <?php if (strpos($arr_school_location[$i], $school_naam) !== false): ?>
                                      <tr>
                                        <td>
                                          <?= $arr_school_name[$i] ?>
                                        </td>
                                        <td>
                                          <?= $arr_school_location[$i] ?>
                                        </td>
                                      </tr>
                                      <?php endif ?>
                                        <?php endforeach; ?>
                                          <?php else: ?>
                                            <tr>
                                              <td>
                                                <?= $arr_school_name[$i] ?>
                                              </td>
                                              <td>
                                                <?= $arr_school_location[$i] ?>
                                              </td>
                                            </tr>
                                            <?php endif ?>
                                              <?php endfor ?>
        </table>

        <!-- LIST (mobile) -->
        <table class="mobile_screen">
          <?php for ($i=0; $i < count($arr_school_name); $i++): ?>
            <?php if (isset($search_term)): ?>
              <?php if (stripos($arr_school_name[$i], $search_term) !== false): ?>
                <tr>
                  <td>
                    <?= $arr_school_name[$i] ?>
                  </td>
                </tr>
                <?php endif ?>
                  <?php elseif (!empty($_SESSION['school_naam'])): ?>
                    <?php foreach ($_SESSION['school_naam'] as $school_naam): ?>
                      <?php if (strpos($arr_school_location[$i], $school_naam) !== false): ?>
                        <tr>
                          <td>
                            <?= $arr_school_name[$i] ?>
                          </td>
                        </tr>
                        <?php endif ?>
                          <?php endforeach; ?>
                            <?php else: ?>
                              <tr>
                                <td>
                                  <?= $arr_school_name[$i] ?>
                                </td>
                              </tr>
                              <?php endif ?>
                                <?php endfor ?>
        </table>

      </div>
    </div>
  </div>

  <script src="{{ asset('js/search_courses.js') }}"></script>

  @endsection