!function() {
    "use strict";
    var e, t, n, a, o = localStorage.getItem("language"),
        s = "en";

    function l(e) {
        document.getElementById("header-lang-img") && ("en" == e ? document.getElementById("header-lang-img").src = "backend/images/flags/us.jpg" : "sp" == e ? document.getElementById("header-lang-img").src = "backend/images/flags/spain.jpg" : "gr" == e ? document.getElementById("header-lang-img").src = "backend/images/flags/germany.jpg" : "it" == e ? document.getElementById("header-lang-img").src = "backend/images/flags/italy.jpg" : "ru" == e && (document.getElementById("header-lang-img").src = "backend/images/flags/russia.jpg"), localStorage.setItem("language", e), o = localStorage.getItem("language"), function() {
            null == o && l(s);
            var e = new XMLHttpRequest;
            e.open("GET", "/backend/lang/" + o + ".json"), e.onreadystatechange = function() {
                var n;
                4 === this.readyState && 200 === this.status && (n = JSON.parse(this.responseText), Object.keys(n).forEach(function(t) {
                    document.querySelectorAll("[data-key='" + t + "']").forEach(function(e) {
                        e.textContent = n[t]
                    })
                }))
            }, e.send()
        }())
    }

    function i() {
        var e = document.querySelectorAll(".counter-value");
        e && e.forEach(function(o) {
            ! function e() {
                var t = +o.getAttribute("data-target"),
                    n = +o.innerText,
                    a = t / 250;
                a < 1 && (a = 1), n < t ? (o.innerText = (n + a).toFixed(0), setTimeout(e, 1)) : o.innerText = t
            }()
        })
    }

    function d() {
        setTimeout(function() {
            var e, t, n, a = document.getElementById("side-menu");
            a && (e = a.querySelector(".mm-active .active"), 300 < (t = e ? e.offsetTop : 0) && (t -= 100, (n = document.getElementsByClassName("vertical-menu") ? document.getElementsByClassName("vertical-menu")[0] : "") && n.querySelector(".simplebar-content-wrapper") && setTimeout(function() {
                n.querySelector(".simplebar-content-wrapper").scrollTop = t
            }, 0)))
        }, 0)
    }

    function r() {
        for (var e = document.getElementById("topnav-menu-content").getElementsByTagName("a"), t = 0, n = e.length; t < n; t++) "nav-item dropdown active" === e[t].parentElement.getAttribute("class") && (e[t].parentElement.classList.remove("active"), e[t].nextElementSibling.classList.remove("show"))
    }

    function c(e) {
        var t = document.getElementById(e);
        t.style.display = "block";
        var n = setInterval(function() {
            t.style.opacity || (t.style.opacity = 1), 0 < t.style.opacity ? t.style.opacity -= .2 : (clearInterval(n), t.style.display = "none")
        }, 200)
    }

    function u() {
        var e, t, n;
        feather.replace(), window.sessionStorage && ((e = sessionStorage.getItem("is_visited")) ? null !== (t = document.querySelector("#" + e)) && (t.checked = !0, n = e, 1 == document.getElementById("layout-direction-ltr").checked && "layout-direction-ltr" === n ? (document.getElementsByTagName("html")[0].removeAttribute("dir"), document.getElementById("layout-direction-rtl").checked = !1, document.getElementById("bootstrap-style").setAttribute("href", "backend/css/bootstrap.min.css"), document.getElementById("app-style").setAttribute("href", "backend/css/app.min.css"), sessionStorage.setItem("is_visited", "layout-direction-ltr")) : 1 == document.getElementById("layout-direction-rtl").checked && "layout-direction-rtl" === n && (document.getElementById("layout-direction-ltr").checked = !1, document.getElementById("bootstrap-style").setAttribute("href", "backend/css/bootstrap-rtl.min.css"), document.getElementById("app-style").setAttribute("href", "backend/css/app-rtl.min.css"), document.getElementsByTagName("html")[0].setAttribute("dir", "rtl"), sessionStorage.setItem("is_visited", "layout-direction-rtl"))) : sessionStorage.setItem("is_visited", "layout-direction-ltr"))
    }

    function m(e) {
        document.getElementById(e) && (document.getElementById(e).checked = !0)
    }

    function g() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.body.classList.remove("fullscreen-enable")
    }

    document.addEventListener("DOMContentLoaded", function(e) {
        // Remove any preloader if it exists
        document.getElementById("preloader") && (c("pre-status"), c("preloader"));
    
        // u();
        
        document.getElementById("side-menu") && new MetisMenu("#side-menu");
        
        i();
    
        var t = document.body.getAttribute("data-sidebar-size");
        if (1024 <= window.innerWidth && window.innerWidth <= 1366) {
            document.body.setAttribute("data-sidebar-size", "sm");
            m("sidebar-size-small");
        }
    
        for (var e = document.getElementsByClassName("vertical-menu-btn"), n = 0; n < e.length; n++) {
            e[n] && e[n].addEventListener("click", function(e) {
                e.preventDefault();
                document.body.classList.toggle("sidebar-enable");
                if (992 <= window.innerWidth) {
                    if (null == t) {
                        if (null == document.body.getAttribute("data-sidebar-size") || "lg" == document.body.getAttribute("data-sidebar-size")) {
                            document.body.setAttribute("data-sidebar-size", "sm");
                        } else {
                            document.body.setAttribute("data-sidebar-size", "lg");
                        }
                    } else {
                        if ("md" == t) {
                            if ("md" == document.body.getAttribute("data-sidebar-size")) {
                                document.body.setAttribute("data-sidebar-size", "sm");
                            } else {
                                document.body.setAttribute("data-sidebar-size", "md");
                            }
                        } else {
                            if ("sm" == document.body.getAttribute("data-sidebar-size")) {
                                document.body.setAttribute("data-sidebar-size", "lg");
                            } else {
                                document.body.setAttribute("data-sidebar-size", "sm");
                            }
                        }
                    }
                } else {
                    d();
                }
            });
        }
    
        (t = document.querySelector('[data-toggle="fullscreen"]')) && t.addEventListener("click", function(e) {
            e.preventDefault();
            document.body.classList.toggle("fullscreen-enable");
            if (document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement) {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            } else {
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            }
        });
    
        document.addEventListener("fullscreenchange", g);
        document.addEventListener("webkitfullscreenchange", g);
        document.addEventListener("mozfullscreenchange", g);
    
        if (document.getElementById("topnav-menu-content")) {
            for (var e = document.getElementById("topnav-menu-content").getElementsByTagName("a"), t = 0, n = e.length; t < n; t++) {
                e[t].onclick = function(e) {
                    if ("#" === e.target.getAttribute("href")) {
                        e.target.parentElement.classList.toggle("active");
                        e.target.nextElementSibling.classList.toggle("show");
                    }
                };
            }
            window.addEventListener("resize", r);
        }
    
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e) {
            return new bootstrap.Tooltip(e);
        });
    
        [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function(e) {
            return new bootstrap.Popover(e);
        });
    
        [].slice.call(document.querySelectorAll(".toast")).map(function(e) {
            return new bootstrap.Toast(e);
        });
    
        if ("null" != o && o !== s) {
            l(o);
        }
    
        var e = document.getElementsByClassName("language");
        e && e.forEach(function(t) {
            t.addEventListener("click", function(e) {
                l(t.getAttribute("data-lang"));
            });
        });
    
        var n = document.getElementById("dash-troggle-icon"),
            a = !0,
            o = document.getElementById("dashtoggle"),
            s = new bootstrap.Collapse(o, { toggle: !1 });
    
        n.addEventListener("click", function() {
            a = !1;
            setTimeout(function() {
                a = !0;
            }, 500);
        });
    
        window.addEventListener("scroll", function() {
            if ((100 < document.documentElement.scrollTop || 0 == document.documentElement.scrollTop) && a) {
                if (20 < window.pageYOffset) {
                    s.hide();
                } else {
                    s.show();
                }
    
                if (window.innerWidth <= 992) {
                    a = !1;
                    setTimeout(function() {
                        a = !1;
                    }, 500);
                    s.hide();
                }
            }
        });
    
        if (a = document.getElementById("checkAll")) {
            a.onclick = function() {
                for (var e = document.querySelectorAll('.table-check input[type="checkbox"]'), t = 0; t < e.length; t++) {
                    e[t].checked = this.checked;
                }
            };
        }
    });
}();