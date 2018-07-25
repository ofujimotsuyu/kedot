  // var pieData = [
  //   {
  //     value: 37,
  //     color:"#9acce3",
  //     highlight: "#aadbf2",
  //     label: "20代"
  //   },
  //   {
  //     value: 30,
  //     color: "#70b062",
  //     highlight: "#7fc170",
  //     label: "30代"
  //   },
  //   {
  //     value: 20,
  //     color: "#dbdf19",
  //     highlight: "#ecef23",
  //     label: "40代"
  //   },
  //   {
  //     value: 10,
  //     color: "#a979ad",
  //     highlight: "#bb8ebf",
  //     label: "おばあちゃん"
  //   },
  //   {
  //     value: 3,
  //     color: "#cd5638",
  //     highlight: "#e2694a",
  //     label: "ひろし"
  //   }

  // ];

  window.onload = function(){
    var ctx = document.getElementById("pie-chart").getContext("2d");
    window.myPie = new Chart(ctx).Pie(pieData);
  };
