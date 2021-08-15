$(document).scroll(function(){
  var isScrolled = $(this).scrollTop() > $(".topBar").height();
  $(".topBar").toggleClass("scrolled", isScrolled);
})
function volumeToggle(button){
  var muted = $(".previewVideo").prop("muted");
  $(".previewVideo").prop("muted", !muted);
  $(button).find("i").toggleClass("fas fa-volume-mute");
  $(button).find("i").toggleClass("fas fa-volume-up"); //wont be able to find in class so this will be applied
}

function previewEnded()
{
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
}

function goBack(){
  window.history.back();
}

function starHideTimer(){
  var timeout = null;
  $(document).on("mousemove",function(){
    clearTimeout(timeout);
    $(".watchNav").fadeIn();

    timeout = setTimeout(function(){
      $(".watchNav").fadeOut();
    },2000);

  })
}

function initVideo(videoId ,username){
  starHideTimer();
  setStartTime(videoId, username);
  updateProgressTimer(videoId, username);
}


function updateProgressTimer(videoId, username)
{
  addDuration(videoId, username);

  var timer;
  $("video").on("playing", function(event){
    window.clearInterval(timer);
    timer = window.setInterval(function() {
      updateProgress(videoId, username, event.target.currentTime);
    }, 3000);
  })
  .on("ended", function(event){
      setFinished(videoId, username);
      window.clearInterval(timer);
  })
}

function addDuration(videoId, username){
    $.post("ajax/addDuration.php", {videoId: videoId,username: username }, function(data){  //after , passes data
      if(data!==null && data!=="")
      {
        alert(data);
      }
    })
}

function updateProgress(videoId, username, progress)
{
  $.post("ajax/updateDuration.php", {videoId: videoId,username: username,progress: progress }, function(data){  //after , passes data
    if(data!==null && data!=="")
    {
      alert(data);
    }
  })
}

function setFinished(videoId, username)
{
  $.post("ajax/setFinished.php", {videoId: videoId,username: username }, function(data){  //after , passes data
    if(data!==null && data!=="")
    {
      alert(data);
    }
  })
}

function setStartTime(videoId, username)
{
  $.post("ajax/getProgress.php", {videoId: videoId,username: username }, function(data){  //after , passes data
    if(isNaN(data)) //is not number
    {
      alert(data);
      return;
    }
    $("video").on("canplay",function(){
    this.currentTime = data;
    $("video").off("canplay");
    })
  })
}

function restartVideo(){
  $("video")[0].currentTime = 0;
  $("video")[0].play();
  $(".upNext").fadeOut();
}

function watchVideo(videoId){
  window.location.href = "watch.php?id=" + videoId;
}

function showUpNext(){
  $(".upNext").fadeIn();
}
