    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <?php
        
        $carouselArray = array(
            
		array(Title => "Thank You Sponsors", IMG=>"robot.jpg", Caption => "Special thanks to all of our sponsors for their support of our program", URL => "/ourteam/sponsorlist/", btn=>"Our Sponsors"),
        array(Title => "Science Night", IMG => "dallas.jpg", Caption => "Dallas interacts with youth at Liberty Oaks Elementary School on Science Night.", URL => "/media/galleries/index.php?gallery=sciencenight&amp;title=Science%20Night", btn => "More photos"),
        array(Title => "Our Team", IMG => "teamphoto2015.jpg", Caption => "FIRST<sup>&reg;</sup> Team 1764 in all of its splendor and glory!", URL => "/ourteam/missionandvalues/", btn => "Find out more"),
        array(Title => "Highway Cleanup", IMG => "hIMG_1199.jpg", Caption => "The team cleans up a stretch of highway adopted through MoDot's Adopt-a-Highway program.", URL => "/media/galleries/index.php?gallery=highway&amp;title=Highway%20Cleanup", btn => "More photos"),
        );

        $imgCounter = count($carouselArray);
  
        for($i=0; $i<$imgCounter; $i++)
        {
        ?>
        <div class="item <?php if($i==0){echo(active);}?>">
        <img src="bootstrap/img/homepage/<?= $carouselArray[$i]["IMG"]; ?>" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1><?= $carouselArray[$i]["Title"]; ?></h1>
              <p class="lead"><?= $carouselArray[$i]["Caption"]; ?></p>
              <a class="btn btn-primary" href="<?= $carouselArray[$i]["URL"]; ?>"><?= $carouselArray[$i]["btn"]; ?> &raquo;</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->

<script>
  $('.carousel').carousel({
  interval: 2000
})
</script>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="span4">
          <img src="/bootstrap/img/homepage/homepage1.jpg" alt="">
          <h2>Team</h2>
          <p>Read about our team's history. Meet past robots and explore content pertaining to team since its creation in 2005.</p>
          <p><a class="btn" href="/ourteam/teamhistory/">Team History &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img src="/bootstrap/img/homepage/Robot_Builds_Me_bw.png" alt="">
          <h2>Robot Builds Me</h2>
          <p>Read testimonies from FIRST<sup>&reg;</sup> Robotics members about the competition's effect on their lives.</p>
          <p><a class="btn" href="/robotbuildsme">Vist Robot Builds Me &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img src="/bootstrap/img/homepage/homepage3.jpg" width="267" style="width:267px;" alt="">
          <h2>CADalog</h2>
          <p>View our catalog of CAD files and submissions.</p>
          <p><a class="btn" href="/resources/cad/">View CADalog &raquo;</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="featurette">
    <div class="pull-right video" style="padding-left: 10px;"><!--<object CLASSID="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" width="480" height="285" CODEBASE="http://www.apple.com/qtactivex/qtplugin.cab">
    <param name="src" value="http://www.usfirst.org/uploadedFiles/Video/FIRST%20Promo%20480x272.mov">
    <param name="autoplay" value="false">
    <param name="loop" value="false">
    <param name="controller" value="true">
    <param name="wmode" value="transparent">
    <embed src="http://www.usfirst.org/uploadedFiles/Video/FIRST%20Promo%20480x272.mov" width="480" height="285" autoplay="true" loop="false" controller="true" pluginspage="http://www.apple.com/quicktime/" wmode="transparent"></embed>
    </object>--><iframe width="640" height="360" src="http://www.youtube.com/embed/i1QyM9WTF18"></iframe></div>
        <h2 class="featurette-heading">What is FIRST<sup>&reg;</sup> Robotics?</h2>
        <p class="lead">Watch this promo video to find out more about FIRST<sup>&reg;</sup> Robotics Competition!</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <div class="pull-left video" style="padding-left: 10px;">
    <!--<OBJECT ID="MediaPlayer" WIDTH="540" HEIGHT="360" CLASSID="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95"
    STANDBY="Loading Windows Media Player components..." TYPE="application/x-oleobject">
    <PARAM NAME="FileName" VALUE="January23.wmv">
    <PARAM name="autostart" VALUE="false">
    <PARAM name="ShowControls" VALUE="true">
    <param name="ShowStatusBar" value="false">
    <PARAM name="ShowDisplay" VALUE="false">
    <param name="wmode" value="transparent">
    <EMBED TYPE="application/x-mplayer2" SRC="January23.wmv" NAME="MediaPlayer"
    WIDTH="510" HEIGHT="340" ShowControls="1" ShowStatusBar="0" ShowDisplay="0" autostart="0" wmode="transparent"></EMBED>
    </OBJECT>-->
    <!--<iframe width="640" height="360" src="http://www.youtube.com/embed/liiswtOukRg?feature=player_detailpage"></iframe>-->
                <iframe width="640" height="360" src="http://www.youtube.com/embed/<?= $videoArray[$vidKeys[0]]; ?>?feature=player_detailpage"></iframe>
    </div>
    <div style="padding-left: 680px;">
        <h2 class="featurette-heading">Watch our latest video diary</h2>
        <p class="lead"><a href="http://www.youtube.com/user/FIRST1764">Check out our Youtube channel!</a> </p>
    </div>
    </div>
      <!-- /END THE FEATURETTES -->
   </div>