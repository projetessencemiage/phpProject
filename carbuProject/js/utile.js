String.prototype.startsWith = function(str) 
{
	return (this.match("^"+str)==str)
	}


function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}