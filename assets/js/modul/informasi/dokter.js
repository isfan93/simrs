

jQuery(document).ready(function() {
//	alert();



	jQuery('.search-hidden').hide();
	jQuery('.show').click(function(){
		jQuery('.search-hidden').slideToggle('fast');


	})

		jQuery('.left-nav-date a').html('&#8249;&#8249;  '+getDates(-1)); 
		jQuery('.tgl-sekarang').html('(' +getDates(0)+')'); 
		jQuery('.right-nav-date a').html(getDates(1)+'  &#8250;&#8250;'); 
 
 jQuery('.left-nav-date a').click(function(){
 	prev_date();
 
 	return false;
 });

jQuery('.right-nav-date a').click(function(){
 	next_date();
 	

 	return false;
 });

jQuery('.reset').click(function(){
	jQuery('.search2 input').val('');
	jQuery('.search2 .uniformselect').val('0');
	return false;
});

//jQuery( ".hasDatepicker" ).datepicker();

$(".search_choice a").click(function(){
	//alert('asdasd');
			$(".active").removeClass('active');
			$(this).addClass('active');
			if($(this).attr('atr') == 'bsc'){
				$("#advance").slideUp('fast');
				$(".mediuminput").focus();
				$('#filter').removeClass();
				$('#filter').addClass('span4 offset2');
				$('.chatsearch').show();


			}else{
				$("#advance").slideDown('fast');
				$('.chatsearch').hide();
			 
				$('#filter').removeClass();
				$('#filter').addClass('span12');
				$(".smallinput").focus();
			}
			return false;
		})

});

function next_date(){
	value  = parseInt(jQuery('#gap').val())+1;
	 
	jQuery('#gap').val(value);
	jQuery('.right-nav-date a').html(getDates(value+1)+'  &#8250;&#8250;');
	jQuery('.left-nav-date a').html('&#8249;&#8249;  '+getDates(value-1));
	jQuery('.tgl-sekarang').html('(' +getDates(value)+')'); 
	jQuery('.tgl_frm').val(getDateRaw(value)); 
	datas = getDateRaw(value);
	crsf = $('.crsf').val();
	 
	 $('.jadwal-dokter').children().remove();
	 $.ajax({
                  url: 'jadwal_dokter/loaddata',
                  type: "POST",
                  crossDomain: true,
                  data: {"csrf_jike_2012":crsf,"tgl":datas},
                  dataType: "html",
                  success: function( data ) {
                  	 
                    $('.jadwal-dokter').append(data);
                  }
                });
}

function prev_date(){
	value  = parseInt(jQuery('#gap').val())-1;
	jQuery('#gap').val(value);
	jQuery('.left-nav-date a').html('&#8249;&#8249;  '+getDates(value-1));
	jQuery('.right-nav-date a').html(getDates(value+1)+'  &#8250;&#8250;');
	jQuery('.tgl-sekarang').html('(' +getDates(value)+')'); 
	jQuery('.tgl_frm').val(getDateRaw(value)); 
	datas = getDateRaw(value);
	crsf = $('.crsf').val();
	 $('.jadwal-dokter').children().remove();
	 $.ajax({
                  url: 'jadwal_dokter/loaddata',
                  type: "POST",
                  crossDomain: true,
                  data: {"csrf_jike_2012":crsf,"tgl":datas},
                  dataType: "html",
                  success: function( data ) {
                  	 
                    $('.jadwal-dokter').append(data);
                  }
                });
}

function getDates(gap){
	 
	var today = new Date();
   var d = today.getDate();
   var m = today.getMonth();
   var y = today.getFullYear();
   var day =[];
  
   var NextDate= new Date(y, m, d+gap);
   x = NextDate.getDay();
   
   day[0] = 'Senin';
   day[1] = 'Selasa';
   day[2] = 'Rabu';
   day[3] = 'Kamis';
   day[4] = "Jum'at";
   day[5] = 'Sabtu';
   day[6] = 'Minggu';
  
   var Ndate = day[x]+', '+NextDate.getDate()+"/"+(NextDate.getMonth()+1)+'/'+NextDate.getFullYear();
   return Ndate;
}

function getDateRaw(gap){
	var today = new Date();
   var d = today.getDate();
   var m = today.getMonth();
   var y = today.getFullYear();

   var NextDate= new Date(y, m, d+gap);
   var Ndate=NextDate.getFullYear()+"-"+parseInt(NextDate.getMonth()+1)+"-"+NextDate.getDate();

   return Ndate;
	}

function getDateRaw2(gap){
	var today = new Date();
   var d = today.getDate();
   var m = today.getMonth();
   var y = today.getFullYear();

   var NextDate= new Date(y, m, d+gap);
   var Ndate=NextDate.getDate()+"/"+parseInt(NextDate.getMonth()+1)+"/"+NextDate.getFullYear();

   return Ndate;
	}