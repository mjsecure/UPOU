<font color="black" size="3"><b>
<script language = "JavaScript">
var now = new Date();
var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
var monNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
document.write("" + dayNames[now.getDay()] + " " + monNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear());
</script></b>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id=tick2>
</span>
<script>
function show2(){
if (!document.all&&!document.getElementById)
return
thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
var ctime=hours+":"+minutes+":"+seconds+" "+dn
thelement.innerHTML="<b style='font-size:14;color:black;'>"+ctime+"</b>"
setTimeout("show2()",1000)
}
window.onload=show2
</script></font>
