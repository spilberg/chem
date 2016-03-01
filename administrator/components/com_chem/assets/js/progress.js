var jQ = jQuery.noConflict();

//jQ('document').ready(function(){
//   jQ(':button[id^="button_"]').on('click',function(e){
//       var mydata = jQ(this).data('options');
//       var progressBar = jQ('#progressbar_' + mydata['id']);
//       e.preventDefault();
//       jQ.ajax({
//           url: '/administrator/index.php?option=com_chem&task=progress',
//           type: 'POST',
//               contentType: false,
//               processData: false,
//           data: mydata,
//           dataType: 'json',
//           xhr: function(){
//               var xhr = jQ.ajaxSettings.xhr();
//               xhr.addEventListener('progress', function(evt){
//                   console.log(evt);
//                   if(evt.lengthComputable){
//                       var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
//                       progressBar.val(percentComplete);
//                   }
//               }, false);
//               return xhr;
//           },
//           success: function(json){
//              if(json){
//                  alert("finished");
//              }
//           }
//       });
//   });
//});

jQ('document').ready(function(){
    function resetBar(mydata) {
        jQ('#progressbar_' + mydata['id']).val(0);
        jQ('#ps_' + mydata['id']).html('0%');
        jQ('#current_' + mydata['id']).html('');
        jQ('#total_' + mydata['id']).html('');
        jQ('#open_' + mydata['id']).html('');
    }

    jQ(':button[id^="button_"]').on('click',function(e){
       var mydata = jQ(this).data('options');
      // var myid =  mydata['id'];
      // var progressBar = jQ('#progressbar_' + mydata['id']);
        resetBar(mydata);
        e.preventDefault();
       if( typeof es !== 'undefined') es.close();
        //if(es != null) es.close();
       sse(mydata);

   });

   jQ(':button[id^="stopbutton_"]').on('click',function(e){
       var mydata = jQ(this).data('options');
       if( typeof es !== 'undefined') {
           es.close();
           resetBar(mydata);
           jQ('#open_' + mydata['id']).html('Stopped!').css({'color':'red', 'font-weight':'bold'});
       }
   });

});

function sse(mydata){

    es = null;
   // var es = null;
     //es = 'es' + mydata['id'];
    es = new EventSource("/administrator/index.php?option=com_chem&task=progress&f=" + mydata['name']);
   // console.log(es);
    var listener = function (event) {
        //var div = document.createElement("div");
       // var type = event.type;
        //   console.log(event.data);
        if(event.data == 'finish;') es.close();
        var atrdata = String(event.data);
        if(atrdata.search('percent') != -1) {
            var dd = event.data.split(':');
            var ps = dd[1].replace(/^\s+|\s+$|;/gm,'');
            jQ('#progressbar_' + mydata['id']).val(ps);
            jQ('#ps_' + mydata['id']).html(ps + '%');
           // console.log(dd[1])
        }

        if(atrdata.search('total') != -1) {
            jQ('#total_' + mydata['id']).html(event.data);
        }

        if(event.type === "message"){
            jQ('#current_'+ mydata['id']).html('Current: ' + event.data);
        }
        //div.appendChild(document.createTextNode(type + ": " + (type === "message" ? event.data : es.url)));
        //document.body.appendChild(div);
    };
    es.addEventListener("open",
        function(event){
            var div = document.createElement("div");
           jQ('#open_'+ mydata['id']).html('Processing now! Please wait!').css({'color':'green', 'font-weight':'bold'});
            //div.appendChild(document.createTextNode(event.type + ": " + (event.type === "message" ? event.data : 'Processing now! Please wait!')));
            //document.body.appendChild(div);
        }
    );
    es.addEventListener("message", listener);
    es.addEventListener("error",
        function(event){
            var div = document.createElement("div");
            var type = event.type;
            console.log(event.data);
            div.appendChild(document.createTextNode(type + ": " +  event.data));
            document.body.appendChild(div);
            es.close();
        }
    );
}


