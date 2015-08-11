<script type="text/javascript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
function getPostcode(z1,z2,a1,a2) {
	new daum.Postcode({
		oncomplete: function(data) {
			var fullAddr	= ''; // 최종 주소 변수
			var extraAddr	= ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') {
				// 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;
			}
			else {
				// 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById(z1).value = data.postcode1;
			document.getElementById(z2).value = data.postcode2;
			document.getElementById(a1).value = fullAddr;
			document.getElementById(a2).focus();
		}
	}).open();
}
</script>
