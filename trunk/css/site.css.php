<?php
  header('content-type: text/css');
  //header('HTTP/1.0 304 Not Modified');

  $htmlBackground = '#ADF';
  $bodyBackground = '#FFF';
  $menuTextColor = '#FFF';
  $contentTextColor = '#FFF';
  $contentBorderColor = '#55F';
  $blockBorderColor = '#00A';
  $blockHeaderBackground = '#00A';
  $blockHeaderColor = '#FFF';
  $galleryTreeSelectedLinkBackground = '#44D';
  $galleryTreeSelectedLinkColor = '#FFF';
  $galleryTreeActiveLink = '#666';
  $galleryTreeLinksColor = '#AAA';
  $galleryTreeLinkHoverBackground = '#BDF';
  $modalBackgroundColor = '#FFF';
  $modalBorderColor = '#CCC';
  $titleColor = '#000';

  $infos = getimagesize('../img/banniere.jpg');
?>

* {
  margin: 0;
  padding: 0;
}

html {
  background: <?php echo $htmlBackground ?>;
  width: 100%;
}

body {
  width: 980px;
  background: <?php echo $bodyBackground ?>;
  margin-left: auto;
  margin-right: auto;
}

img {
  border: none;
}

#header {
  width: 980px;
  height: <?php echo $infos[1]?>px;
}

a, a:visited {
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

.center {
  text-align: center;
}

.width100 {
  width: 100px;
}

.width50 {
  width: 50px;
}

.smaller {
  font-size: 12px;
}

.pointer {
  cursor: pointer;
}

td {
  vertical-align: top;
}

.clearer {
  clear: both;
}

.right {
  text-align: right;
}

#menu {
  position: relative;
  top: -35px;
}

#menu a {
  color: <?php echo $menuTextColor ?>;
  font-weight: bold;
  font-family: arial;
  font-size: 14px;
  margin-left: 15px;
  vertical-align: bottom;
}

#menu_languages {
  float: right;
}

#menu_languages a {
  margin: 0 5px 0 0;
}

#content {
  background: <?php echo $contentTextColor ?>;
  border: 2px solid <?php echo $contentBorderColor ?>;
}

.blockWithHeader {
  border: 1px solid <?php echo $blockBorderColor ?>;
  margin: 10px;
}

.blockWithHeader h2 {
  background: <?php echo $blockHeaderBackground ?>;
  padding: 10px;
  border-bottom: 1px solid <?php echo $blockBorderColor ?>;
  color: <?php echo $blockHeaderColor ?>;
}

.blockWithHeaderContent {
  padding: 10px;
}

#latest_updates {
  width: 250px;
  float: left;
  margin-right: 10px;
}

#disclaimer {
  margin: 20px 10px;
  text-align: justify;
  margin-left: 280px;
  width: 670px;
}

#latest_news {
  margin-left: 280px;
  width: 670px;
}

#header, #body, #footer {
  width: 100%;
}

#footer {
  height: 100px;
  background: url(<?APPLICATION_URL?>css/start/images/ui-bg_gloss-wave_75_2191c0_500x100.png);
}

#galleryTree {
  float: left;
  width: 250px;
  padding-bottom: 15px;
  margin-left: 10px;
  margin-top: 10px;
  background: url(<?APPLICATION_URL?>img/background_block_bottom.png) no-repeat left bottom;
}

#galleryTree h2 {
  text-align: center;
  margin-bottom: 10px;
}

#galleryTreeTop {
  padding-top: 15px;
  background: url(<?APPLICATION_URL?>img/background_block_top.png) no-repeat left top;
}

#galleryTreeMiddle {
  padding: 0 10px;
  background: url(<?APPLICATION_URL?>img/background_block_middle.png) repeat-y left;
}

h1 {
  width: 980px;
  text-align: center;
  margin-bottom: 20px;
  color: <?php echo $titleColor ?>;
}

h1.galleries {
  width: 680px;
}

#galleryContent {
  float: right;
  width: 680px;
  padding: 10px;
}

div.clearBoth {
  clear: both;
  width: 100%;
}

p.formError {
  color: #F22;
  font-style: italic;
  margin-left: 20px;
  font-weight: bold;
}

/* --------------------------------------------------- */
/* -------------------- GALLERIES -------------------- */

.subGalleries {
  text-align: center;
  width: 650px;
  margin-bottom: 10px;
  margin-left: auto;
  margin-right: auto;
}

.subGalleries img {
  display: block;
  text-align: center;
  margin: auto;
}

.subGalleries4 {
  width: 520px;
}

.subGalleries3 {
  width: 390px;
}

.subGalleries2 {
  width: 260px;
}

.subGalleries1 {
  width: 130px;
}

.subGalleries p {
  float: left;
  width: 130px;
}

#galleryImages {
  text-align: center;
}

#galleryImages img {
  margin: 5px;
}

/* --------------------------------------------------- */
/* ------------------- FORMS ------------------------- */

form {
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 10px;
}

legend {
  margin-left: 10px;
}

form p {
  margin: 5px 10px;
  width: 90%;
}

form p label {
  float: left;
  width: 150px;
}

.submit {
  text-align: right;
}

.submit input {
  padding: 0 5px;
}

form.form500 {
  width: 500px;
}

/* --------------------------------------------------- */
/* ------------------- MEMBERS ----------------------- */

#fenetre {
  display: none;
  padding: 10px;
}

#fenetre fieldset {
  padding: 5px;
}

.spinner {
  vertical-align: middle;
  width: 100%;
  height: 400px;
  background: transparent url(<?APPLICATION_URL?>img/spinner.gif) no-repeat center;
}

.spinner_small {
  vertical-align: middle;
  width: 100%;
  height: 20px;
  background: transparent url(<?APPLICATION_URL?>img/spinner_small.gif) no-repeat center;
  position: absolute;
  top: 200px;
}

#fenetreText {
  height: 450px;
  overflow-y: auto;
}

#fenetreBottom {
  height: 28px;
  padding-top: 5px;
}

#fenetreText #fieldsetTree0 {
  height: 300px;
  overflow-y: auto;
}

#fenetreText #fieldsetTree1 {
  height: 380px;
  overflow-y: auto;
}

#fenetreText #fieldsetTree0 #galleryTree0 {
  height: 300px;
  overflow-y: auto;
  overflow-x: hidden;
}

#fenetreText #fieldsetTree1 #galleryTree0 {
  height: 380px;
  overflow-y: auto;
  overflow-x: hidden;
}

ul.galleryTree a.linkGallerySelected {
  font-weight: bold;
  background: <?php echo $galleryTreeSelectedLinkBackground ?>;
  color: <?php echo $galleryTreeSelectedLinkColor ?>;
}

.shortLabel label {
  width: 50px;
}

.shortLabel input {
  width: 400px;
}

.linkWithArrow {
  text-align: center;
  margin-bottom: 5px;
}

.linkWithArrow a {
  background: url(<?APPLICATION_URL?>img/fleche.png) no-repeat left;
  padding-left: 20px;
}

.infos {
  font-style: italic;
}

/* --------------------------------------------------- */
/* ------------------- TABLES ----------------------- */

table.table {
  border-collapse: collapse;
}

table.table th {
  background-image: url(<?APPLICATION_URL?>img/gradient_light_blue.png);
  background-position: 0 -120px;
}

table.table th, table.table td {
  padding: 2px 5px;
}

table thead tr {
  border: 1px solid #CCC;
}

table.table td {
  border: 1px solid #CCC;
}

.tdForm {
  background-image: url(<?APPLICATION_URL?>img/gradient_blue_long.png);
}

/* -------------------------------------------------------------------- */

.jcu_file_container {
  padding: 5px;
  border: 2px groove #F0F0F0;
}

/* -------------------------------------------------------------------- */
ul.galleryTree {
  font-family: Verdana, sans-serif;
  font-size: 10px;
  line-height: 18px;
  padding: 0px;
  margin: 0px;
}

ul.galleryTree ul {
  font-size: 9px;
}

ul.galleryTree .active {
  font-weight: bold;
  color: <?php echo $galleryTreeActiveLink ?>;
}

.galleryTreeRealRoot {
  padding-left: 1em;
  margin: 0;
}

ul.galleryTree li {
  list-style: none;
  padding: 0px;
  padding-left: 20px;
  margin: 0px;
}

ul.galleryTree a {
  color: <?php echo $galleryTreeLinksColor ?>;
  text-decoration: none;
  display: block;
  padding: 0px 2px;
}

ul.galleryTree a:hover {
  background: <?php echo $galleryTreeLinkHoverBackground ?>;
}

.galleryTree li div.spinner { position: absolute; left: 0; top: 0; padding: 0; margin: 0; }

/* Core Styles */
.galleryTree li.directory { background: url(<?APPLICATION_URL?>img/directory.png) left top no-repeat; }
.galleryTree li.expanded { background: url(<?APPLICATION_URL?>img/folder_open.png) left top no-repeat; }
.galleryTree li.file { background: url(<?APPLICATION_URL?>img/file.png) left top no-repeat; }
.galleryTree li.wait { background: none; position: relative;}
/* File Extensions*/
.galleryTree li.ext_3gp { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_afp { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_afpa { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_asp { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_aspx { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_avi { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_bat { background: url(<?APPLICATION_URL?>/application.png) left top no-repeat; }
.galleryTree li.ext_bmp { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_c { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_cfm { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_cgi { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_com { background: url(<?APPLICATION_URL?>/application.png) left top no-repeat; }
.galleryTree li.ext_cpp { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_css { background: url(<?APPLICATION_URL?>/css.png) left top no-repeat; }
.galleryTree li.ext_doc { background: url(<?APPLICATION_URL?>/doc.png) left top no-repeat; }
.galleryTree li.ext_exe { background: url(<?APPLICATION_URL?>/application.png) left top no-repeat; }
.galleryTree li.ext_gif { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_fla { background: url(<?APPLICATION_URL?>/flash.png) left top no-repeat; }
.galleryTree li.ext_h { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_htm { background: url(<?APPLICATION_URL?>/html.png) left top no-repeat; }
.galleryTree li.ext_html { background: url(<?APPLICATION_URL?>/html.png) left top no-repeat; }
.galleryTree li.ext_jar { background: url(<?APPLICATION_URL?>/java.png) left top no-repeat; }
.galleryTree li.ext_jpg { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_jpeg { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_js { background: url(<?APPLICATION_URL?>/script.png) left top no-repeat; }
.galleryTree li.ext_lasso { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_log { background: url(<?APPLICATION_URL?>/txt.png) left top no-repeat; }
.galleryTree li.ext_m4p { background: url(<?APPLICATION_URL?>/music.png) left top no-repeat; }
.galleryTree li.ext_mov { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_mp3 { background: url(<?APPLICATION_URL?>/music.png) left top no-repeat; }
.galleryTree li.ext_mp4 { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_mpg { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_mpeg { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_ogg { background: url(<?APPLICATION_URL?>/music.png) left top no-repeat; }
.galleryTree li.ext_pcx { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_pdf { background: url(<?APPLICATION_URL?>/pdf.png) left top no-repeat; }
.galleryTree li.ext_php { background: url(<?APPLICATION_URL?>/php.png) left top no-repeat; }
.galleryTree li.ext_png { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_ppt { background: url(<?APPLICATION_URL?>/ppt.png) left top no-repeat; }
.galleryTree li.ext_psd { background: url(<?APPLICATION_URL?>/psd.png) left top no-repeat; }
.galleryTree li.ext_pl { background: url(<?APPLICATION_URL?>/script.png) left top no-repeat; }
.galleryTree li.ext_py { background: url(<?APPLICATION_URL?>/script.png) left top no-repeat; }
.galleryTree li.ext_rb { background: url(<?APPLICATION_URL?>/ruby.png) left top no-repeat; }
.galleryTree li.ext_rbx { background: url(<?APPLICATION_URL?>/ruby.png) left top no-repeat; }
.galleryTree li.ext_rhtml { background: url(<?APPLICATION_URL?>/ruby.png) left top no-repeat; }
.galleryTree li.ext_rpm { background: url(<?APPLICATION_URL?>/linux.png) left top no-repeat; }
.galleryTree li.ext_ruby { background: url(<?APPLICATION_URL?>/ruby.png) left top no-repeat; }
.galleryTree li.ext_sql { background: url(<?APPLICATION_URL?>/db.png) left top no-repeat; }
.galleryTree li.ext_swf { background: url(<?APPLICATION_URL?>/flash.png) left top no-repeat; }
.galleryTree li.ext_tif { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_tiff { background: url(<?APPLICATION_URL?>/picture.png) left top no-repeat; }
.galleryTree li.ext_txt { background: url(<?APPLICATION_URL?>/txt.png) left top no-repeat; }
.galleryTree li.ext_vb { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_wav { background: url(<?APPLICATION_URL?>/music.png) left top no-repeat; }
.galleryTree li.ext_wmv { background: url(<?APPLICATION_URL?>/film.png) left top no-repeat; }
.galleryTree li.ext_xls { background: url(<?APPLICATION_URL?>/xls.png) left top no-repeat; }
.galleryTree li.ext_xml { background: url(<?APPLICATION_URL?>/code.png) left top no-repeat; }
.galleryTree li.ext_zip { background: url(<?APPLICATION_URL?>/zip.png) left top no-repeat; }

/* simple modal */
#simplemodal-overlay {
  background-color: #000;
  cursor: wait;
}

#simplemodal-container {
  height: 500px;
  width: 600px;
  background-color: <?php echo $modalBackgroundColor ?>;
  border: 3px solid <?php echo $modalBorderColor ?>;
}

#simplemodal-container.large {
  width: 980px;
}

#simplemodal-container a.modalCloseImg {
  background: url(<?APPLICATION_URL?>images/x.png) no-repeat;
  width: 25px;
  height: 25px;
  display: inline;
  z-index: 3200;
  position: absolute;
  top: -15px;
  right: -18px;
  cursor: pointer;
}

#simplemodal-container #basicModalContent {
  padding: 8px;
}

.am_formMsgError{
  font-size: 0.813em;
  font-weight: bold;
  color: #e31919;
  margin-left: 190px;
  padding: 5px 0;
  display: none;
}