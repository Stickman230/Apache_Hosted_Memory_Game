srcArray = []


function validateInput() {
    validWord = true
    const input = document.getElementById("username-input").value;
    inputLength = true
    var invalidChars = ["!","@","#","%","&","*","(",")","+","=","^","{","}","[","\\","]","-",";",":","'","<",">","?","/"]
    for (chars in invalidChars) {
        if (input.includes("!") || input.includes("@") || input.includes("#") ||
            input.includes("%") || input.includes("&") || input.includes("*") ||
            input.includes("(") || input.includes(")") || input.includes("+") ||
            input.includes("=") || input.includes("^") || input.includes("{") ||
            input.includes("}") || input.includes("[") || input.includes("\\") ||
            input.includes("]") || input.includes("-") || input.includes(";") ||
            input.includes(":") || input.includes("'") || input.includes("<") ||
            input.includes(">") || input.includes("?") || input.includes("/")) {
                validWord = false}
    }
    if (input == ""){
	validWord = false; }

    if (input.length > 20) {
	inputLength = false;}

    if (validWord == false) {
        document.getElementById("error-message").style.display ="block";
        return false; }

    if (inputLength == false) {
        document.getElementById("error-message2").style.display ="block";
        return false; }

    const formR = document.getElementById("content");
    formR.style.display ="none";
    changePage(); 
}   

function changePage(){
    document.getElementById("content").style.display = "";
    document.getElementById("Rtext").style.display = "none";
    document.getElementById("username-input").style.display = "none";
    document.getElementById("Next").style.display = "none";
    document.getElementById("error-message").style.display = "none";
    document.getElementById("error-message2").style.display = "none";

    document.getElementById("background2").style.height = "75%"
    document.getElementById("background2").style.top = "20%"
    document.getElementById("avatarText").style.display = "block";
    document.getElementById("arrows").style.display = "flex";
    document.getElementById("emoji").style.display = "block";
    document.getElementById("StartP").style.display = "block";    
}


document.getElementById("emojiE").src = `emoji assets/eyes/closed.png`;
document.getElementById("emojiM").src = `emoji assets/mouth/open.png`;
document.getElementById("emojiS").src = `emoji assets/skin/green.png`;

let currentEyeIndex = 0;
let currentMouthIndex = 0;
let currentSkinIndex = 0;

const eyeImages = ["closed.png", "laughing.png", "long.png", "normal.png", "rolling.png", "winking.png"];
function changeEye() {
    
    // Select an eye image
    
    // Increment the current index, and wrap around if necessary
    currentEyeIndex = (currentEyeIndex + 1) % eyeImages.length;
    
    // Set the image source to the new index
    document.getElementById("emojiE").src = `emoji assets/eyes/${eyeImages[currentEyeIndex]}`;
    const finalEye = currentEyeIndex;
    return  finalEye 
}
const mouthImages = ["open.png", "sad.png", "smiling.png", "straight.png", "surprise.png", "teeth.png"];
function changeMouth() {
    // Select a random mouth image
    

    // Increment the current index, and wrap around if necessary
    currentMouthIndex = (currentMouthIndex + 1) % mouthImages.length;
    
    // Set the image source to the new index
    document.getElementById("emojiM").src = `emoji assets/mouth/${mouthImages[currentMouthIndex]}`;
    const finalMouth = currentMouthIndex;
    return finalMouth 
}
const skinImages = ["green.png", "red.png", "yellow.png"];
function changeSkin() {
    // Select a random skin image
    
    
    // Increment the current index, and wrap around if necessary
    currentSkinIndex = (currentSkinIndex + 1) % skinImages.length;
    
    // Set the image source to the new index
    document.getElementById("emojiS").src = `emoji assets/skin/${skinImages[currentSkinIndex]}`;
    const finalSkin = currentSkinIndex;
    return finalSkin
}         

function regEye(){
    let rE = changeEye()-1
    if (rE == -1){
        return 5}
    
    return rE
}

function regMouth(){
    let rM = changeMouth()-1
    if (rM == -1){
        return 5}
    
    return rM
}

function regSkin(){
    let rS = changeSkin()-1
    if (rS == -1){
        return skinImages.length -1}
    
    return rS
}
 
function HasLogedIn(event){
    const finalEye = regEye();
    console.log(finalEye + " eye")
    const finalMouth = regMouth();
    console.log(finalMouth + " mouth")
    const finalSkin = regSkin();
    console.log(finalSkin + " skin")
    
    srcArray.push(`emoji assets/eyes/${eyeImages[finalEye]}`);
    srcArray.push(`emoji assets/mouth/${mouthImages[finalMouth]}`);
    srcArray.push(`emoji assets/skin/${skinImages[finalSkin]}`);
    console.log(srcArray)
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
        }
    };
    xhr.open('POST', 'registration.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('srcArray=' + JSON.stringify(srcArray));
    return true;
}
