var cnt = 0;

function gettestcolor(per) {

   
    if (cnt == 0) {

        var colour = '';
        if (per < 20) {
            colour = "#ff043f";
        }
        else if (per >= 20 && per < 40) {
            colour = "#fc6ba9";
        }
        else if (per >= 40 && per < 60) {
            colour = "#ffaa62";
        }
        else if (per >= 60 && per < 70) {
            colour = "#f7d54e";
        }
        else if (per >= 70 && per < 80) {
            colour = "#8bd470";
        }
        else if (per >= 80 && per < 90) {
            colour = "#00b289";
        }
        else if (per >= 90) {
            colour = "#009bdf";
        }
        cnt++;
        return colour;
    }

}



function getcolorcode(per) {

        var colour = '';
        if (per <= 20) {
            colour = "#DF591E";
        }
        else if (per <= 40) {
            colour = "#FFC73C";
        }
        else if (per <= 60) {
            colour = "#3CBBE6";
        }
        else if (per <= 70) {
            colour = "#058FC2";
        }
        else if (per <= 80) {
            colour = "#66BE00";
        }
        else if (per < 90) {
            colour = "#B3C40E";
        }

        else if (per >= 90) {
            colour = "#527206";

        }
       
        return colour;
}



function getlevel(per)
{
var colour = '';
if (per =='L1') {
    colour = "#DF591E";
}
else if (per =='L2') {
    colour = "#FFC73C";
}
else if (per == 'L3') {
    colour = "#3CBBE6";
}
else if (per =='L4') {
    colour = "#058FC2";
}
else if (per =='L5') {
    colour = "#66BE00";
}
else if (per =='L6') {
    colour = "#B3C40E";
}

else if (per =='L7') {
    colour = "#527206";

}
       
return colour;
}

