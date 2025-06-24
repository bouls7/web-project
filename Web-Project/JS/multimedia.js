
const videoSources = [
  './mediaa/video1.mp4',
  './mediaa/video2.mp4',
  './mediaa/video3.mp4',
  './mediaa/video4.mp4',
  './mediaa/video5.mp4'
];
let videoIndex = 0;

function scrollVideos(direction) {
  console.log("Arrow clicked, direction:", direction);
  videoIndex += direction;

  if (videoIndex < 0) {
    videoIndex = videoSources.length - 1;
  } else if (videoIndex >= videoSources.length) {
    videoIndex = 0;
  }

  const video = document.getElementById('mainVideo');
  video.src = videoSources[videoIndex];
  video.play();
}




function showTab(tabId) {
  const contents = document.querySelectorAll('.tab-content');
  contents.forEach(div => div.style.display = 'none');

  document.getElementById(tabId).style.display = 'block';
}

function changeImage(thumbnail) {
  const mainImage = document.getElementById('mainImage');
  mainImage.src = thumbnail.src;
}


function changeAudio(audioSrc) {
  const audioPlayer = document.getElementById('audioPlayer');
  audioPlayer.src = audioSrc;
  audioPlayer.play();
}