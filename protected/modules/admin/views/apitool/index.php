<div id="contentHeader">
  <h3>IP 查询</h3>
  
</div>
<form action="<?php echo $this->createUrl('ipquery')?>" method="post" id="apiForm" name="apiForm">
  <table class="content_list">
    <tr class="noborder">
        <td class="vtop rowform">
        	IP 地址查询：
        	<input name="ip" type="" id="ip" value=""/>
            <button id="submitIp" value="查询">查询</button>
        </td>
    </tr>
  </table>
</form>
<form action="<?php echo $this->createUrl('weather')?>" method="post" id="weatherForm" name="weatherForm">
  <table class="content_list">
    <tr class="noborder">
        <td class="vtop rowform">
        	城市天气：
        	<input name="cityName" type="" id="cityName" value=""/>
            <button id="submitWeather" value="查询">查询</button>
            <button id="submitWeather2" value="查询2" onclick="javascript:;return false;">查询2</button>
            <span id="searchInfo" ></span>
        </td>
    </tr>
  </table>
</form>

<script type="text/javascript">
//alert();
//$(function () {

    $('#submitWeather2').click(function(){
        //alert(1);
        var url = '';

         $.ajax({  
                url:"<?php echo $this->createUrl('weather')?>&dataFmt=json",   
                type : 'POST',
                data : {cityName:$('#cityName').val()},
                dataType : 'json',  
                //contentType : 'application/x-www-form-urlencoded',  
                async : false,  
                success : function(mydata) {  
                        console.log("success");  
                        //alert(mydata);  
                        console.log(mydata);
                        var show_data = '';
                        for (var i=0; i<mydata['retData'].length; ++i)
                        {
                            var rec = mydata['retData'][i];
                            show_data += '<h1>line:'+ rec.district_cn + ':' + rec.name_cn +'</h1><br/>';
                        }
                        //var show_data = "<h1>result:" + mydata + "</h1>";  
                        $("#searchInfo").html(show_data);  
                },  
                error : function(data) {  
                        //alert(data['errNum']);
                        //console.log(data);
                        console.log(data.responseText);
                        //alert("calc failed");  
                }  
        });
        });
//});
</script>
