/*
* Dashboard UI code.
*/
var audioElement, currentInterval, currentButton;
const jsmediatags = window.jsmediatags;
const tabs = document.querySelectorAll('[data-tab-target]');
const playButtons = document.querySelectorAll('[data-play-location]');
const deleteButtons = document.querySelectorAll('[data-audio-id]');
const tabContents = document.querySelectorAll('[data-tab-content');

const uploadButton = document.querySelector("#Upload-Button");
const modalCloseButton = document.querySelector('#ModalClose');

const uploadFileInput = document.querySelector("#Upload-File");
const songNameInput = document.querySelector("#Song-Name");
const artistNameInput = document.querySelector("#Artist-Name");


uploadFileInput.addEventListener("change", (event)=> {
    const file = event.target.files[0];
    if(file == null) { return; }
    var songName = "";
    var artistName = "";

    jsmediatags.read(file, {
        onSuccess: function(tag) {
            console.log(tag.tags.TPE2);
            if(tag.tags.TPE2 != null) {
                artistNameInput.value = tag.tags.TPE2.data;
            }
        },
        onError: function(error) {
            console.log(error);
        }
    });
    var newFileName = file.name;
    songNameInput.value = newFileName.substring(0, newFileName.lastIndexOf('.')) || newFileName;

});

uploadButton.addEventListener('click', () => {
    const modalDiv = document.querySelector('#Modal');
    modalDiv.classList.add('animated');
    modalDiv.classList.add('fadeIn');
    modalDiv.style.display = "block";
});

modalCloseButton.addEventListener('click', () => {
    const modalDiv = document.querySelector('#Modal');
    modalDiv.classList.remove('fadeIn');
    modalDiv.classList.add('fadeOut');
    setTimeout(()=> {
        modalDiv.classList.remove('fadeOut');
        modalDiv.style.display = "none";
    }, 1000);
});

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget);
        tabContents.forEach(tabContent => tabContent.classList.remove('active'));
        tabs.forEach(tab => tab.classList.remove('active'));
        tab.classList.add('active');
        target.classList.add('active');
    });
});

playButtons.forEach(button => {
    button.addEventListener('click', PlayButtonToggle, false);
});

function CreateLoadingInterval() {
    currentInterval = setInterval(()=>{
        if(audioElement.readyState == HTMLMediaElement.HAVE_FUTURE_DATA || audioElement.readyState == HTMLMediaElement.HAVE_ENOUGH_DATA ||
            audioElement.paused == false) {
            console.log("Button fix!");
            console.log(currentButton);
            currentButton.classList.remove("fa-spinner");
            currentButton.classList.remove("spin")
            currentButton.classList.add("fa-pause");
            clearInterval(currentInterval);
        }
    }, 50);
}

function PlayButtonToggle(e) {
    const currentSrc = audioElement.src;
    const button = e.target;
    if(currentSrc == '' || currentSrc != button.dataset.playLocation) {
        const newSrc = button.dataset.playLocation;
        audioElement.src = newSrc;
        audioElement.play();

        currentButton = button;
        button.playing = true;
        ResetPlayButtons();
        button.classList.remove('fa-play');
        button.classList.add('fa-spinner');
        button.classList.add('spin');
        CreateLoadingInterval();
    } else {
        //Currently playing this button, pause it.
        ResetPlayButtons();
        if(audioElement.paused) {
            audioElement.play();
            button.classList.remove('fa-play');
            button.classList.add('fa-pause');
        } else {
            audioElement.pause();
        }
    }
}

function ResetPlayButtons() {
    playButtons.forEach(button => {
        button.classList.remove('fa-pause');
        button.classList.remove('fa-spinner');
        button.classList.remove('spin');
        button.classList.add('fa-play');
        button.playing = false;
    });
}

//Make audio container
audioElement = document.createElement('AUDIO');
audioElement.id = "Player";
audioElement.addEventListener('ended', ()=> {
    this.src = "";
    ResetPlayButtons();
});
document.body.appendChild(audioElement);
