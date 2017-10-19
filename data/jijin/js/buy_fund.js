window.onload = function() {
  getFundType();
};

function getFundType() {
  var data;
  mui.ajax('/jijin/Jz_fund/getFundData', {
    dataType: 'json',
    type: 'post',
    async: false,
    data: {
      fundtype: 0
    },
    timeout: 10 * 1000,
    success: function(res) {
      console.log(res);
      if (!res) {
        alert('无数据！');
      } else if (res.code !== '0000' || !res.code) {
        alert('返回数据错误');
      } else {
        var filter = document.getElementById('screenFund');
        if (res.qryallfund == 1) {
          filter.innerHTML = '根据证监会适当性管理办法，产品列表已根据您的风险等级作筛选。您已主动要求查看高于您风险等级的产品。<a href="/jijin/jz_fund/viewAllFund">前往了解</a>';
        } else if (res.qryallfund == 0) {
          filter.innerHTML = '根据证监会适当性管理办法，产品列表已根据您的风险等级作筛选。<a href="/jijin/jz_fund/viewAllFund">前往了解</a>';
        } else {
          filter.style.display = 'none';
        }
        renderFundType(res.fundTypes);
        renderFundList(0);
      }
    },
    error: function(xhr) {
      alert('请求错误');
    }
  })
}

function renderFundType(data) {
  if (!data) {
    alert('无基金类型!');
    return false;
  }
  var wrapNav = document.getElementById('sliderSegmentedControl');
  var wrapCon = document.querySelector('.mui-slider-group');
  for (var i = 0; i < data.length; i++) {
    var ele = document.createElement('a');
    ele.classList.add('mui-control-item');
    ele.innerHTML = '<span>' + data[i].name.replace(/基金/, '') + '</span>';
    ele.href = '#fund' + data[i].type;
    ele.dataset.type = data[i].type;
    wrapNav.appendChild(ele);

    var con = document.createElement('div');
    con.classList.add('mui-slider-item', 'mui-control-content');
    con.id = 'fund' + data[i].type;
    con.innerHTML = '<div class="mui-scroll-wrapper" id="scroll' + data[i].type + '">' +
      '<div class="mui-scroll">' +
      '<ul class="mui-table-view">' +
      '<div class="mui-loading">' +
      '<div class="mui-spinner"></div>' +
      '</div>' +
      '</ul>' +
      '</div>' +
      '</div>';
    var seeHeight = document.documentElement.clientHeight;
    var navHeight = document.querySelector('.mui-bar-tab').clientHeight;
    var sliderHeight = document.getElementById('sliderSegmentedControl').clientHeight;
    var topHeight = document.getElementById('screenFund').clientHeight;
    var h = seeHeight - sliderHeight - navHeight - topHeight;
    con.style.height = h + 'px';
    wrapCon.appendChild(con);
  }
  wrapNav.firstElementChild.classList.add('mui-active');
  wrapCon.firstElementChild.classList.add('mui-active');

  initScroll(mui);
}



function renderFundList(fundtype) {
  mui.ajax('/jijin/Jz_fund/getFundData', {
    dataType: 'json',
    type: 'post',
    async: true,
    data: {
      fundtype: fundtype
    },
    timeout: 10 * 1000,
    success: function(res) {
      var fundListData = res.data[fundtype];
      var listWrap = document.getElementById('fund' + fundtype).querySelector('.mui-scroll');
      var listTitle = document.createElement('div');
      if (!listWrap.parentElement.firstElementChild.classList.contains('fundlist-title')) {
        listTitle.classList.add('fundlist-title');
        listTitle.innerHTML = '<div class="fundlist-name">基金名称</div><div class="fundlist-networth">单位净值(元)</div><select class="fundlist-chg"><option value="1">日涨幅</option><option value="2">近一月</option><option value="3">近三月</option><option value="4">近六月</option><option value="5">近一年</option></select><span></span>';
        listWrap.parentNode.insertBefore(listTitle, listWrap);
      }
      console.log(fundtype);
      if (!res.data[fundtype]) {
        listWrap.innerHTML = '<p class="fund-list-error"><span>暂无基金</span></p>';
      } else {

        listWrap.innerHTML = '';
        var fundListData = res.data[fundtype];

        if (fundtype == 2) {
          listTitle.innerHTML = '<div class="fundlist-name">基金名称</div><div class="fundlist-networth">万分收益(元)</div><div class="fundlist-return">七日年化</div>';
          var frag = document.createElement('ul');
          frag.classList.add('mui-table-view');
          for (var i = 0; i < fundListData.length; i++) {
            var oLi = document.createElement('li');
            oLi.setAttribute('class', 'mui-table-view-cell');
            oLi.innerHTML = '<a href="' + '/jijin/Jz_fund/showprodetail?fundcode=' + fundListData[i].fundcode + '" class="fundlist-link"><div class="fundlist-name">' + fundListData[i].fundname + '</div><div class="fundlist-networth">' + fundListData[i].fundincomeunit + '</div><div class="fundlist-growthrate">' + (fundListData[i].growthrate * 100).toFixed(2) + '%</div></a>';
            frag.appendChild(oLi);
          }
          listWrap.appendChild(frag);
        } else {

          var fragDay = document.createElement('ul');
          fragDay.classList.add('mui-table-view');
          var fragOnemonth = document.createElement('ul');
          fragOnemonth.classList.add('mui-table-view');
          var fragThreemonth = document.createElement('ul');
          fragThreemonth.classList.add('mui-table-view');
          var fragSixmonth = document.createElement('ul');
          fragSixmonth.classList.add('mui-table-view');
          var fragYear = document.createElement('ul');
          fragYear.classList.add('mui-table-view');

          for (var i = 0; i < fundListData.length; i++) {
            var oLiDay = document.createElement('li');
            oLiDay.classList.add('mui-table-view-cell');
            oLiDay.innerHTML = '<a href="' + '/jijin/Jz_fund/showprodetail?fundcode=' + fundListData[i].fundcode + '" class="fundlist-link"><div class="fundlist-name">' + fundListData[i].fundname + '</div><div class="fundlist-networth">' + fundListData[i].nav + '</div><div class="fundlist-growthrate">' + (fundListData[i].growth_day * 100).toFixed(2) + '%</div></a>';
            fragDay.appendChild(oLiDay);

            var oLiOne = document.createElement('li');
            oLiOne.classList.add('mui-table-view-cell');
            oLiOne.innerHTML = '<a href="' + '/jijin/Jz_fund/showprodetail?fundcode=' + fundListData[i].fundcode + '" class="fundlist-link"><div class="fundlist-name">' + fundListData[i].fundname + '</div><div class="fundlist-networth">' + fundListData[i].nav + '</div><div class="fundlist-growthrate">' + (fundListData[i].growth_onemonth * 100).toFixed(2) + '%</div></a>';
            fragOnemonth.appendChild(oLiOne);

            var oLiThree = document.createElement('li');
            oLiThree.classList.add('mui-table-view-cell');
            oLiThree.innerHTML = '<a href="' + '/jijin/Jz_fund/showprodetail?fundcode=' + fundListData[i].fundcode + '" class="fundlist-link"><div class="fundlist-name">' + fundListData[i].fundname + '</div><div class="fundlist-networth">' + fundListData[i].nav + '</div><div class="fundlist-growthrate">' + (fundListData[i].growth_threemonth * 100).toFixed(2) + '%</div></a>';
            fragThreemonth.appendChild(oLiThree);

            var oLiSix = document.createElement('li');
            oLiSix.classList.add('mui-table-view-cell');
            oLiSix.innerHTML = '<a href="' + '/jijin/Jz_fund/showprodetail?fundcode=' + fundListData[i].fundcode + '" class="fundlist-link"><div class="fundlist-name">' + fundListData[i].fundname + '</div><div class="fundlist-networth">' + fundListData[i].nav + '</div><div class="fundlist-growthrate">' + (fundListData[i].growth_sixmonth * 100).toFixed(2) + '%</div></a>';
            fragSixmonth.appendChild(oLiSix);

            var oLiYear = document.createElement('li');
            oLiYear.classList.add('mui-table-view-cell');
            oLiYear.innerHTML = '<a href="' + '/jijin/Jz_fund/showprodetail?fundcode=' + fundListData[i].fundcode + '" class="fundlist-link"><div class="fundlist-name">' + fundListData[i].fundname + '</div><div class="fundlist-networth">' + fundListData[i].nav + '</div><div class="fundlist-growthrate">' + (fundListData[i].growth_year * 100).toFixed(2) + '%</div></a>';
            fragYear.appendChild(oLiYear);
          }
          listWrap.innerHTML = '';
          listWrap.appendChild(fragDay);
          chgIncrease(fundtype, fragDay, fragOnemonth, fragThreemonth, fragSixmonth, fragYear);
        }
      }
    },
    error: function(res) {
      alert('请求错误，请稍候重试');
    }
  })
}

function chgIncrease(type, day, one, three, six, year) {
  var wrap = document.getElementById('fund' + type).querySelector('.mui-scroll');
  var select = document.getElementById('fund' + type).querySelector('.fundlist-chg');
  select.addEventListener('change', function(e) {
    console.log(e.target.value);
    console.log(one);
    switch (e.target.value) {
      case '1':
        wrap.innerHTML = '';
        wrap.appendChild(day);
        break;
      case '2':
        wrap.innerHTML = '';
        wrap.appendChild(one);
        break;
      case '3':
        wrap.innerHTML = '';
        wrap.appendChild(three);
        break;
      case '4':
        wrap.innerHTML = '';
        wrap.appendChild(six);
        break;
      case '5':
        wrap.innerHTML = '';
        wrap.appendChild(year);
        break;
      default:
        break;
    }
  })
}


function initScroll($) {
  var gallery = mui('.mui-slider');
  gallery.slider();
  document.getElementById('slider').addEventListener('slide', function(e) {
    var con = e.target.querySelector('#sliderSegmentedControl');
    var tar = con.querySelector('.mui-active');
    console.log(tar.dataset.type);
    var load = e.target.querySelector('.mui-slider-group');
    if (load.querySelector('.mui-loading')) {
      renderFundList(tar.dataset.type);
    }
  });
  var sliderSegmentedControl = document.getElementById('sliderSegmentedControl');
  sliderSegmentedControl.addEventListener('tap', function(e) {
      console.log(e.target);
    })
    /* $('.mui-input-group').on('change', 'input', function() {
      if (this.checked) {
        alert(1);
        sliderSegmentedControl.className = 'mui-slider-indicator mui-segmented-control mui-segmented-control-inverted mui-segmented-control-' + this.value;
        //force repaint
        sliderProgressBar.setAttribute('style', sliderProgressBar.getAttribute('style'));
      }
    }); */
};