<html>

<head>
  <title>Comic Viewer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/images/comics.png" />
  <link href="assets/css/index.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
  <?php
  include "../lib/config.php";
  include "../lib/reqUtils.php";

  // https://stackoverflow.com/questions/42348196/synology-access-from-web-directory-to-other-directory

  if (!array_key_exists('p_dir', $_GET)) $_GET['p_dir'] = "/";

  $dirBase = $CONFIG['local_base_dir'] . $_GET['p_dir'];
  $dirhandle = opendir($dirBase);
  while ($filename = readdir($dirhandle)) {
    if (substr($filename, 0, 1) == "@") continue;
    if (substr($filename, 0, 1) == ".") continue;
    if (is_dir($dirBase . $filename)) {
      $listDirs[] = $filename;
    } else {
      if (substr($filename, -3) != "zip") continue;
      $listFiles[] = $filename;
    }
  }
  closedir($dirhandle);


  // Upper Dirs
  $curr_dir_title = "";
  echo "<a class=\"folder_link\" href=\"index.php\"><span class=\"material-symbols-outlined\">home</span></a>";
  if (array_key_exists('p_dir', $_GET)) {
    $upperDirs = explode("/", $_GET['p_dir']);
    $dl = "";
    foreach ($upperDirs as $dir) {
      if ($dir == "") continue;
      $dl .= $dir . "/";
      $curr_dir_title = $dir;
      echo " &gt; <a class=\"folder_link\" href=\"index.php?p_dir=" . urlencode($dl) . "\">" . $dir . "</a>";
    }
  }
  echo "<hr>";
  echo "<ul>";

  // Sub Dirs
  if (isset($listDirs)) {
    sort($listDirs, SORT_NATURAL);
    foreach ($listDirs as $filename) {
      echo "<li><div><a class=\"folder_link\" href=\"index.php?p_dir=" . urlencode($_GET['p_dir'] . $filename . "/") . "\"><span class=\"material-symbols-outlined\">folder</span> " . $filename . "</a></div></li>";
    }
  }

  // Files
  
  if (isset($listFiles)) {
    sort($listFiles, SORT_NATURAL);
    foreach ($listFiles as $filename) {
      $FILEDATA = loadFileData($_GET['p_dir'] . $filename);
      if (array_key_exists("PAGE", $FILEDATA)) {
        if ($FILEDATA["PAGE_TOTAL"] != 0) {
          $width = ($FILEDATA["PAGE"] * 100 / $FILEDATA["PAGE_TOTAL"]) . "px";
          $PAGE_INFO = "<div class=\"bargraph\"><div class=\"bargraph_progress\" style=\"width:$width;\"></div></div>";
        }
      } else {
        $PAGE_INFO = "";
      }


      $p_filename = urlencode($_GET['p_dir'] . $filename);
      $filename = str_replace($curr_dir_title, "", $filename);
      $filename = str_replace(".zip", "", $filename);
      echo "<li>"
        . "<div>"
        . $PAGE_INFO
        . "<a href=\"view.php?p_filename=$p_filename\"><div class=\"book_link\">$filename</div></a>"
        . "</div>\n";
    }
  }
  echo "</ul>";
  ?>
</body>

</html>