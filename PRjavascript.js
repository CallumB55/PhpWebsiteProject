var index=1;



function moveToNextSlide()
{

	var img = document.getElementById("img1");
var slideName="images/img" + index++ + ".jpg";
img.src=slideName;
if(index == 6){
	index =1;


}
}

function today()
{
	var date = new Date();
	var now = date.getTime();
	document.getElementByName("startDate")[0].setAttribute("min",now.toISOString())

}

