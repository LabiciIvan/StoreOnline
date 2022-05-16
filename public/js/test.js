

document.querySelectorAll('#replayForm').forEach(replay => {replay.addEventListener('click', triggerReplayForm)});
document.querySelectorAll('#ReplayFormAdmin').forEach(replay => {replay.addEventListener('click', triggerReplayForm)});
document.querySelectorAll('#reviewForm').forEach(replay => {replay.addEventListener('click', triggerReviewForm)});


function triggerReplayForm(index) {
    
  let parent = index.target;
  
  let childText = parent.querySelector('#replayArea');
  let childButton = parent.querySelector('#replayAreaButton');


    if(childText.style.display === 'none') {
      childText.style.display = '';
      childButton.style.display = '';
  } else {
    childText.style.display = 'none';
    childButton.style.display = 'none';
  }

} 

function triggerReviewForm(index) {

 let parent = index.target;

 let childText = parent.querySelector('#reviewArea');
 let childButton = parent.querySelector('#reviewButton');

 if(childText.style.display === 'none') {
  childText.style.display = '';
  childButton.style.display = '';
} else {
  childText.style.display = 'none';
  childButton.style.display = 'none';
}

}

function check() {
  alert('works');
}