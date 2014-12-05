<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    @yield('head')
    </head>
    <body>
        <div id="tabs" style="width:50%; margin-left:25%;">
            @yield('menu', '<p>Menu was not included</p>')
            <!-- page tabs -->
            @for($i=1; $i<5; $i++)
                    @yield('tabs'.$i, '<p>Tab #'.$i.' was not included</p>')
            @endfor
        </div>
    </body>
</html>