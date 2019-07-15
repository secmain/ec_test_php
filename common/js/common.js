// アップ画像表示処理
function disp_upfile() {
	var zone = document.getElementById('image-zone');
	if (!zone) return;
	zone.style.backgroundImage = 'url(' + document.getElementById('url').value + ')';
	zone.style.backgroundSize = 'contain';
	zone.style.backgroundRepeat =  'no-repeat';
}