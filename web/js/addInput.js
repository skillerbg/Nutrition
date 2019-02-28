var counter = 1;
var limit = 3;
function addInput(divName){
    if (counter == limit)  {
        alert("You have reached the limit of adding " + counter + " inputs");
    }
    else {


        var newdiv = document.createElement('div');
        newdiv.innerHTML = "Entry " + (counter + 1) + " <input type=\"text\" name=\"recipe[]\" id=\"country\" class=\"form-control input-lg\" autocomplete=\"off\" placeholder=\"Type Country Name\" />\n";
        document.getElementById(divName).appendChild(newdiv);
        counter++;
    }
}