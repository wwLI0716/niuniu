var Dashboard = (function () {

    var translate = {
        copyLink: "Copy Link"
    }

    var user = null;

    var _startLoading = function (item) {
        var html = `
        <div class="custom-overlay" id="idOverlay${item.replace("#", "")}">
            <div class="loading-spinner-container">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>`;
        var el = $(html).appendTo("#overlayMapping");
        $(item).loading({
          overlay: el
        });
    }

    var _formatCurrency = function (value) {
        return (value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    var _gen_url = function (url) {
        if (user)
            return url + "?user="+user;
        return url;
    }

    var _processBalance = function () {
        $.get(_gen_url("/components/dashboard/balance/"), function (data) {
            $("#spanTotalBalance").text(data.total_balance.toString());
            $("#spanBalance").text(data.balance.toString());
            $('#boxTotalBalance').loading('destroy');
            $('#boxBalance').loading('destroy');
        })
    };

    var _processEarnings = function () {
        $.get(_gen_url("/components/dashboard/earnings/"), function (data) {
            $("#spanShowpercent").text(data.showpercent.toString());
            $("#spanLeftDays").text(data.left_days.toString());
            $("#spanLastProfit").text(_formatCurrency(data.pay));
            $("#spanPayPackege").text(data.pay_packege.toString());
            $("#chartPayPackege").data('easyPieChart').update(Math.floor(data.pay_packege));
            if (data.pay && data.trader){
                $("#spanTraderPercent").text(data.trader.percent.toString());
            } else {
                $("#spanTraderPercent").text('0');
            }
            $('#boxEarnings').loading('destroy');
        })
    };

    var _processTeam = function () {
        $.get(_gen_url("/components/dashboard/team/"), function (data) {
            $("#spanUsersLeft").text(data.users_left.toString());
            $("#spanScoreLeft").text(data.score_left.toString());
            $("#spanUsersRight").text(data.users_right.toString());
            $("#spanScoreRight").text(data.score_right.toString());
            if (data.side == 2){
                $("#btnActiveLeft").addClass("btn-success");
            } else {
                $("#btnActiveRight").addClass("btn-success");
            }
            $('#boxTeam1').loading('destroy');
            $('#boxTeam2').loading('destroy');
        })
    };

    var _processResume = function () {
        $.get(_gen_url("/components/dashboard/resume/"), function (data) {
            $("#spanResumeUsername").text(data.username);
            $("#spanPlanStr").text(data.plan_str);
            var status = "INACTIVE";

            if (data.status == 2){
                status = "ACTIVE";
            } else if (data.status == 4) {
                status = "EXPIRED";
            }

            var binaryQualify = ((data.is_binary) ? "YES" : "NO" )
            
            $("#spanResumoStatus").text(status);
            $("#spanResumoBinaryQualify").text(binaryQualify);
            if (data.score_total)
                $("#spanResumoCarrerPoints").text(data.score_total.toString());

            if (data.award_img) {
                var elImg = $('<img  src="/static' + data.award_img+'" style="width: 30%; text-align: center !important;  margin-bottom: -20px;"></img>')
                $("#itemCarrerImg").append(elImg)
            }

            if (data.url_invite) {
                var htmlInvite = `
                <input type="text" value="${data.url_invite}"
                    id="link-partner"
                    class="invite-link-input">
                <div class="clearfix"></div>
                <button onclick="copyLink()" class="waves-effect waves-light btn btn-success btn-sm">${translate.copyLink}</button>`;
                $("#itemInviteLink").html(htmlInvite);
            }
            $("#boxResume").loading('destroy');

        })
    };

    var _lockDivs = function () {
        _startLoading("#boxTotalBalance");
        _startLoading("#boxBalance");
        _startLoading("#boxEarnings");
        _startLoading("#boxTeam1");
        _startLoading("#boxTeam2");
        _startLoading("#boxResume");
        $(':loading').loading('resize');
    }

    var init = function (options) {
        translate = options.translate;
        user = ((options.user) ? options.user : null);

        $('body').on('expanded.pushMenu collapsed.pushMenu', function () {
            setTimeout(function () {
                $(':loading').loading('resize');
            }, 500);
        })

        _lockDivs();
        _processBalance();
        _processEarnings();
        _processTeam();
        _processResume();
    }
    
    return {
        init: init
    };
})();
