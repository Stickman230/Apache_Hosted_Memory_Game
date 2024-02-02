let clickCount = 0;
const eyeImages = ["closed.png", "laughing.png", "long.png", "normal.png", "rolling.png", "winking.png"];
const mouthImages = ["open.png", "sad.png", "smiling.png", "straight.png", "surprise.png", "teeth.png"];
const skinImages = ["green.png", "red.png", "yellow.png"];
let E1, M1, S1, E2, M2, S2, E3, M3, S3, E4, M4, S4, E5, M5, S5;
const cards = document.querySelectorAll('.memory-card');
let nbrOfCards = cards.length;
let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
let score = 0;
let startTime, elapsedTime = 0, timerInterval;
const stressSong = document.getElementById("music");
const winSong = document.getElementById("music2");

function startGame() {
  document.getElementById("startButt").style.display = "none";
  document.getElementById("memory-game").style.display = "flex";
  stressSong.currentTime = 13;
  stressSong.play();
  shuffle();
  generateRandomEmojis();
  pairRandomEmojis(E1, M1, S1, E2, M2, S2, E3, M3, S3, E4, M4, S4, E5, M5, S5);
  startTimer();
}

function generateRandomEmojis() {
  E1 = Math.random();
  M1 = Math.random();
  S1 = Math.random();
  E2 = Math.random();
  M2 = Math.random();
  S2 = Math.random();
  E3 = Math.random();
  M3 = Math.random();
  S3 = Math.random();
  E4 = Math.random();
  M4 = Math.random();
  S4 = Math.random();
  E5 = Math.random();
  M5 = Math.random();
  S5 = Math.random();
}

            

function flipCard() {
    if (lockBoard || this === firstCard) return;
    this.classList.add('flip');
    console.log("card has been clicked")
    
    clickCount += 1

    if (!hasFlippedCard) {
    hasFlippedCard = true;
    firstCard = this;
    return;
    }

    secondCard = this;
    hasFlippedCard = false;
    lockBoard = true;
    checkForMatch();
}

function checkForMatch() {
    let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;
    isMatch ? disableCards() : unflipCards();
}

function disableCards() {
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);
    nbrOfCards -= 2
    console.log(nbrOfCards)
    endgame()
    lockBoard = false;
}

function unflipCards() {
    lockBoard = true;
    setTimeout(() => {
    firstCard.classList.remove('flip');
    secondCard.classList.remove('flip');
    lockBoard = false;
    }, 1000);
}

cards.forEach(card => card.addEventListener('click', flipCard));

function endgame(){
    console.log("we are in the endgame now ")
    if (nbrOfCards === 0) {
    stopTimer()
    stressSong.pause();
    winSong.play();
    let timeVar = updateTimer()
    score += (timeVar.minutes * 60 + timeVar.seconds)*clickCount
    const time = document.getElementById("timer").textContent;
    setTimeout(() => {
        console.log(clickCount);
        let endResponse = alert ("Well done you finished in : "+ time +"\nWith "+clickCount+" clicks \nYour score is : "+score);
        document.getElementById("memory-game").style.display = "none";
        document.getElementById("PlayAgain").style.display = "block";
        document.getElementById("PlayAgain").style.left = "30%";
        if (HasLogedIn()){
        document.getElementById("SubScore").style.display = "block";
        document.getElementById("SubScore").style.left = "55%";
        }},1000);
    } 
}

function resetgame() {
    cards.forEach(card=>{
    card.addEventListener('click', flipCard);
    card.classList.remove('flip');
    
    })
    nbrOfCards = cards.length;
    clearInterval(timerInterval);
    elapsedTime = 0
    document.getElementById("timer").textContent = '00:00:00';
    score = 0
    document.getElementById("memory-game").style.display= "none"
    document.getElementById("startButt").style.display = "block"
}

function HasLogedIn(){
    if (logged == true){
	return true;}
}

function shuffle() {
    cards.forEach(card => {
    let ramdomPos = Math.floor(Math.random() * nbrOfCards);
    card.style.order = ramdomPos;
    });
}


function startTimer() {
    startTime = new Date().getTime() - elapsedTime;
    timerInterval = setInterval(updateTimer, 100); // update every 100 milliseconds
    
}

function stopTimer() {
    clearInterval(timerInterval);
}


function updateTimer() {
    elapsedTime = new Date().getTime() - startTime;
    let minutes = Math.floor((elapsedTime / 1000 / 60) % 60);
    let seconds = Math.floor((elapsedTime / 1000) % 60);
    let milliseconds = Math.floor((elapsedTime % 1000) / 10);
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    milliseconds = milliseconds < 10 ? "0" + milliseconds : milliseconds;
    document.getElementById("timer").innerHTML = `${minutes}:${seconds}:${milliseconds}`;
    return { minutes, seconds };
}

function playAgain(){
    document.getElementById("PlayAgain").style.display ="none"
    document.getElementById("SubScore").style.display = "none";
    clickCount = 0;
    resetgame()
}

function submitScore() {
    document.getElementById("SubScore").style.display ="none";
    document.getElementById("PlayAgain").style.display ="none";
    document.getElementById("timerValue").value = document.getElementById("timer").textContent;
    console.log(document.getElementById("timerValue").value + " time value");
    document.getElementById("clicks").value = clickCount;
    console.log(document.getElementById("clicks").value + " clicks value");
    document.getElementById("score").value = score;
    
    clickCount = 0;
    resetgame()
    window.open('leaderboard.php',"_self");
}



function generateEmoji(eye,mouth,skin) {
    
    // Select a random eye image
    const randomEyeIndex = Math.floor(eye * eyeImages.length);
    const eyeImage = eyeImages[randomEyeIndex];

    // Select a random mouth image
    const randomMouthIndex = Math.floor(mouth * mouthImages.length);
    const mouthImage = mouthImages[randomMouthIndex];

    // Select a random skin image
    const randomSkinIndex = Math.floor(skin * skinImages.length);
    const skinImage = skinImages[randomSkinIndex];

                
    const emojiImageEUrl = `emoji assets/eyes/${eyeImage}`;
    const emojiImageMUrl = `emoji assets/mouth/${mouthImage}`;
    const emojiImageSUrl = `emoji assets/skin/${skinImage}`;
    return {emojiImageEUrl,emojiImageMUrl,emojiImageSUrl};     
} 

function pairRandomEmojis(eye1,mouth1,skin1,eye2,mouth2,skin2,eye3,mouth3,skin3,eye4,mouth4,skin4,eye5,mouth5,skin5 ) {
    const cards = document.querySelectorAll('.memory-card');
    
    for (let i = 0; i < cards.length; i++) {
        const dataFramework = cards[i].getAttribute('data-framework');
        const frontFaces = cards[i].querySelectorAll('.front-face');
        const ideye = frontFaces[0];
        const idmouth = frontFaces[1];
        const idskin = frontFaces[2];
    
        if (dataFramework === '1') {
        const emojis = generateEmoji(eye1,mouth1,skin1);
        ideye.setAttribute('src', emojis.emojiImageEUrl);
        idmouth.setAttribute('src', emojis.emojiImageMUrl);
        idskin.setAttribute('src', emojis.emojiImageSUrl); 
        }
        
        if (dataFramework === '2') {
        const emojis = generateEmoji(eye2,mouth2,skin2);
        ideye.setAttribute('src', emojis.emojiImageEUrl);
        idmouth.setAttribute('src', emojis.emojiImageMUrl);
        idskin.setAttribute('src', emojis.emojiImageSUrl); 
        }
        if (dataFramework === '3') {
        const emojis = generateEmoji(eye3,mouth3,skin3);
        ideye.setAttribute('src', emojis.emojiImageEUrl);
        idmouth.setAttribute('src', emojis.emojiImageMUrl);
        idskin.setAttribute('src', emojis.emojiImageSUrl); 
        }
        if (dataFramework === '4') {
        const emojis = generateEmoji(eye4,mouth4,skin4);
        ideye.setAttribute('src', emojis.emojiImageEUrl);
        idmouth.setAttribute('src', emojis.emojiImageMUrl);
        idskin.setAttribute('src', emojis.emojiImageSUrl); 
        }
        if (dataFramework === '5') {
        const emojis = generateEmoji(eye5,mouth5,skin5);
        ideye.setAttribute('src', emojis.emojiImageEUrl);
        idmouth.setAttribute('src', emojis.emojiImageMUrl);
        idskin.setAttribute('src', emojis.emojiImageSUrl); 
        }
    }
}

