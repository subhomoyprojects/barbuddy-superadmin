$(document).ready( function(){

    get_graph_data();   // get data for Graph

    // get data for Graph
    function get_graph_data(){

        $.ajaxSetup({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });

        $.ajax({
            type: "GET",
            url: ajax_url+'get_data_for_graph',
            success: function(data){

                // console.log('data',data)
                plot_graph(data);   //call function to plot graph
                $('.loader_drink').show();

            }
        });
    }


    //graph plotting
    function plot_graph( graphData){

        if(document.querySelector("#myChart")){

            var ctx                      = $("#myChart");
            // var pincodeList              = Object.keys(graphData);
            var labelsArray              = [];
            var barcountPerLabelArray    = [];
            var backgroundColorArray     = [];
            var borderColorArray         = [];
        
            for (var c in graphData) {

                barcountPerLabelArray.push(graphData[c].count);

                var geocoder = new google.maps.Geocoder();
                var latlng = {lat: parseFloat(graphData[c].latitude), lng: parseFloat(graphData[c].longitude)};
                geocoder.geocode({'location': latlng}, function(results, status) {

                    if (status === 'OK') {

                        if (results[0]) {

                            // console.log('success response',results[0])
                            labelsArray.push(results[0].address_components[3].long_name);

                        }
                        else {
                            labelsArray.push('Unknown');   //No results found
                        }
                    }
                    else {
                        // console.log('Geocoder failed due to: ' + status);
                        labelsArray.push('Unknown'); //Geocoder failed due to

                    }

                });

                                                //css for the graph
                backgroundColorArray.push('#' + (Math.random().toString(16) + "000000").substring(2,8));
                borderColorArray.push('#' + (Math.random().toString(16) + "000000").substring(2,8));
                                            //end css for the graph
            }

            // console.log('labelsArray',labelsArray);
            // console.log('barcountPerLabelArray',barcountPerLabelArray);

            setTimeout(
                function(){

                    // for( var i = 0 ; i< barcountPerLabelArray.length ; i++){
                    //     console.log('labelsArray',labelsArray[i],'barcountPerLabelArray',barcountPerLabelArray[i]);
                    //     // labelsArray.push(graphData[c]);
            
                    //     if(labelsArray[i] == undefined){
                    //         labelsArray.push('Unknown');
                    //     }
            
                    // }

                    $('.loader_drink').hide();
                    var myChart = new Chart(ctx, {
                    type: 'bar',    //bar
                    data: {
                        labels: labelsArray,
                        datasets: [{
                            label: '# of Bars',
                            data: barcountPerLabelArray,
                            backgroundColor: backgroundColorArray,
                            borderColor: borderColorArray,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive : true,
                        scales: {
            
                            xAxes: [{
                                gridLines: {
                                    offsetGridLines: false
                                },
                                ticks: {
                                    fontFamily: "Open Sans",
                                    fontColor: "#738f9d",
                                    fontStyle: "600"
                                  }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    fontFamily: "Open Sans",
                                    fontColor: "#738f9d",
                                    fontStyle: "600"
                                }
                            }],
                        },
                        title: {
                            display: true,
                            position: "top",
                            text: "Pie Chart For Top 10 Cities with Maximum Number Of Bars",
                            fontSize: 18,
                            fontFamily: "Lato",
                            fontColor: "#212529",
                            fontStyle: "600"
                            // fontColor: "#111"
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "#212529",
                                fontFamily: "Open Sans",
                                fontStyle: "600",
                                fontSize: 16
                            }
                        }
                    }
                    });
            },3000);

            }
    }

    //end graph plotting

});

