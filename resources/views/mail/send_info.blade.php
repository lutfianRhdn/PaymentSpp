
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Password</title>
</head>
<body>
  <div id="Web_1366__1">
    <svg class="Rectangle_1">
      <rect id="Rectangle_1" rx="42" ry="42" x="0" y="0" width="392" height="560">
      </rect>
    </svg>
    <div id="Your_Password">
      <span>Your Password</span>
    </div>
    <div id="Dear_test__Here_is_your_passwo">
      <span>Dear {{$user->name}},<br/>
        <br/>Here is your password :  <br/>
        <br/>Email : {{$user->email}}<br/>
        Password : {{$password}} </span>
    </div>
    <a href="{{url('/')}}"  id="Group_1">
      <svg class="Rectangle_2">
        <rect id="Rectangle_2" rx="33" ry="33" x="0" y="0" width="283" height="75">
        </rect>
      </svg>
      <div id="Password">
        <span>go to login</span>
      </div>
</a>

  </div>
  </body>
</html>

<style type="text/css">
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    border: none;
  }
  #Web_1366__1 {
    position: absolute;
    width: 1366px;
    height: 768px;
    background-color: rgba(255,255,255,1);
    overflow: hidden;
    --web-view-name: Web 1366 – 1;
    --web-view-id: Web_1366__1;
    --web-scale-on-resize: true;
    --web-enable-deep-linking: true;
  }
  #Rectangle_1 {
    fill: rgba(255,255,255,1);
    stroke: rgba(112,112,112,1);
    stroke-width: 1px;
    stroke-linejoin: miter;
    stroke-linecap: butt;
    stroke-miterlimit: 4;
    shape-rendering: auto;
  }
  .Rectangle_1 {
    position: absolute;
    overflow: visible;
    width: 392px;
    height: 560px;
    left: 487px;
    top: 104px;
  }
  #Your_Password {
    left: 547px;
    top: 177px;
    position: absolute;
    overflow: visible;
    width: 274px;
    white-space: nowrap;
    text-align: left;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: bold;
    font-size: 40px;
    color: rgba(31,41,55,1);
  }
  #Dear_test__Here_is_your_passwo {
    left: 557px;
    top: 255px;
    position: absolute;
    overflow: visible;
    width: 212px;
    white-space: nowrap;
    text-align: left;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    color: rgba(112,112,112,1);
  }
  #Group_1 {
    position: absolute;
    width: 283px;
    height: 75px;
    left: 542px;
    top: 530px;
    overflow: visible;
    background: none;
  }
  #Rectangle_2 {
    fill: rgba(16,185,129,1);
    stroke: rgba(112,112,112,1);
    stroke-width: 1px;
    stroke-linejoin: miter;
    stroke-linecap: butt;
    stroke-miterlimit: 4;
    shape-rendering: auto;
  }
  .Rectangle_2 {
    position: absolute;
    overflow: visible;
    width: 283px;
    height: 75px;
    left: 0px;
    top: 0px;
  }
  #Password {
    left: 75px;
    top: 18px;
    position: absolute;
    overflow: visible;
    width: 134px;
    white-space: nowrap;
    text-align: left;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: bold;
    font-size: 30px;
    color: rgba(31,41,55,1);
  }
</style>
