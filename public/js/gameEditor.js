var Rmonth = "Jan";
var Rday="01";
var Ryear="2000"
var Cmonth = "Jan";
var Cday="01";
var Cyear="2000"

function SetReleaseDate( ){
    var date = Rmonth + " " + Rday +", " + Ryear;
    document.getElementById("date-release").value = date;
}
function SetCrackDate( ){
    var date = Cmonth + " " + Cday +", " + Cyear;
    document.getElementById("date-crack").value = date;
}

//Start Generate dropDowns day & year
var dayDrop = document.getElementById("day-drops-r");
for(i=1;i<32;i++){
    dayDrop.innerHTML += "<a class="+"dropdown-item "+" onclick="+"SetReleaseDay(this)"+ ">"+i+"</a>" 
}
var yearDrop = document.getElementById("year-drops-r");
for(i=1;i<32;i++){
    yearDrop.innerHTML += "<a class="+"dropdown-item "+" onclick="+"SetReleaseYear(this)"+ ">"+(i+1998)+"</a>"
}
 dayDrop = document.getElementById("day-drops-c");
for(i=1;i<32;i++){
    dayDrop.innerHTML += "<a class="+"dropdown-item "+" onclick="+"SetCrackDay(this)"+ ">"+i+"</a>" 
}
 yearDrop = document.getElementById("year-drops-c");
for(i=1;i<32;i++){
    yearDrop.innerHTML += "<a class="+"dropdown-item "+" onclick="+"SetCrackYear(this)"+ ">"+(i+1998)+"</a>"
}
//end Generate 

function SetReleaseMonth(x){
    document.getElementById("dropdown-month-release").innerHTML= x.innerHTML;
        Rmonth=x.innerHTML;
        SetReleaseDate();
}
function SetReleaseDay(x){
    document.getElementById("dropdown-day-release").innerHTML= x.innerHTML;
    Rday=x.innerHTML;
    SetReleaseDate();
}
function SetReleaseYear(x){
    document.getElementById("dropdown-year-release").innerHTML= x.innerHTML;
    Ryear=x.innerHTML;
    SetReleaseDate();
}

function SetCrackMonth(x){
    document.getElementById("dropdown-month-crack").innerHTML= x.innerHTML;
        Cmonth=x.innerHTML;
        SetCrackDate();
}
function SetCrackDay(x){
    document.getElementById("dropdown-day-crack").innerHTML= x.innerHTML;
    Cday=x.innerHTML;
    SetCrackDate();
}
function SetCrackYear(x){
    document.getElementById("dropdown-year-crack").innerHTML= x.innerHTML;
    Cyear=x.innerHTML;
    SetCrackDate();
}


