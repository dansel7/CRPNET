/**
 * Funcion que sirve para catalogos normales, al presionar en el boton de Update para que setee el campo id del registro a
 * editar y que haga submit del form especificado. Esta funcion aplica solo si se tiene un solo form en la jsp
 */
function updateRow(formName, idField, idRow, actionToDo, urlParams, isPopup) {
    var oldActionPath = '';
    document.getElementById(idField).value=idRow;
    var formulario;
    if(formName == '')
        formulario = document.forms[0];
    else
        formulario = document.getElementsByName(formName)[0];

    if(isPopup) {
        oldActionPath = formulario.action;
        window.open("","nueva",opciones);
        formulario.target="nueva";
    }
    else
        formulario.target="_self";

    formulario.action=actionToDo + '?' + urlParams;
    formulario.submit();

    if(isPopup) {
        formulario.action = oldActionPath;
        formulario.target="_self";
    }
}


    /**
     * Funcion que sirve para ser utilizada en mantenimientos comunes que cuentan con
     * la accion de eliminar, lo que hace basicamente es mostrar un cuadro de confirmacion
     * respecto a eliminar el elemento, si acepta, se hace submit del formulario.
     */
    function confirmEliminar(formName, determinante, nomElemento) {
        var selec = '';
        var formulario;
        if(formName == '')
            formulario = document.forms[0];
        else
            formulario = document.getElementsByName(formName)[0];

        if(determinante == 'el')
            selec = ' seleccionado?';
         else
            selec = ' seleccionada?';
        determinante += ' ';
        if(confirm('Esta seguro que desea eliminar ' + determinante + nomElemento + selec))
            return true;
        else
            return false;
    }

    function regresarLista() {
        try {
            document.getElementById('comando').value = 'BCK';
        } catch(e){}
        return true;
    }

    function restrictDecimal(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        
        if((charCode > 31 && charCode >= 48 && charCode <= 57) || 
        (charCode == 8 || charCode == 46 || charCode == 37 || charCode == 39 || charCode == 9))
                return true;

            return false;

    }
    
    function restrictNum(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if((charCode > 31 && charCode >= 48 && charCode <= 57) || 
        (charCode == 8 || charCode == 37 || charCode == 39 || charCode == 9))
                return true;

            return false;
    }
//

    function restrictNumDigitsDecimals(evt, idelement, maxDigits, maxDecimals)
    {
        var arrCaret = caretPosition(idelement);
        try {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if(charCode == 8 || charCode == 46) return true;
            if(charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
                return false;
            }
            else {
                //Validamos si no esta excediendo la cantidad de decimales especificada
                if( (parseInt(arrCaret[1]) - parseInt(arrCaret[0])) == parseInt(arrCaret[2]) )
                    return true;
                if(document.getElementById(idelement).value.indexOf('.') != -1) {
                    var valor = document.getElementById(idelement).value;
                    var currdecimals = valor.substring(valor.indexOf('.') + 1, valor.length);
                    var currdigits = 0;
                    if(valor.indexOf('.') != -1)
                        currdigits = valor.substring(0, valor.indexOf('.'));
                    else
                        currdigits = valor.substring(0, valor.length);
                    //Validamos que no hayan mas decimales que los permitidos cuando quiera escribir decimales,
                    //es decir que el cursor este despues del punto decimal
                    if(currdigits.length + 1 > maxDigits && charCode != 8 &&
                            (arrCaret[1] <= valor.indexOf('.') || valor.indexOf('.') == -1))
                        return false;
                    if(currdecimals.length + 1 > maxDecimals && charCode != 8 && arrCaret[1] > valor.indexOf('.'))
                        return false;
                    //Validaciones respecto al punto decimal
                    if(charCode == 46 && valor.indexOf('.') != -1) { //Si ya tenia un punto decimal, no permitir otro
                        return false;
                    }
                }
                else {
                    currdigits = document.getElementById(idelement).value.substring(0, document.getElementById(idelement).value.length);
                    if(currdigits.length + 1 > maxDigits && charCode != 8 && charCode != 46)
                        return false;
                }
            }
        }catch(e){}
        return true;
    }

    function caretPosition(idelem)
    {
            var campo = document.getElementById(idelem);
            if (document.selection) {// IE Support
                    campo.focus();                                        // Set focus on the element
                    var oSel = document.selection.createRange();        // To get cursor position, get empty selection range
                    oSel.moveStart('character', -campo.value.length);    // Move selection start to 0 position
                    campo.selectionEnd = oSel.text.length;
                    oSel.setEndPoint('EndToStart', document.selection.createRange() );
                    campo.selectionStart = oSel.text.length; // The caret position is selection length
            }
            var arrRet = new Array(3);
            arrRet[0] = campo.selectionStart;
            arrRet[1] = campo.selectionEnd;
            arrRet[2] = document.getElementById(idelem).value.length;
            return arrRet;
    }

function showListOfValues(lovName, isMultiple, parameters, jsFunction){
    window.open('lov.do?accion=lov&lov=' + lovName + '&multiple=' + isMultiple + '&jsFunction=' + jsFunction + '&' + parameters + '','mywindow1','menubar=1,resizable=1,width=500,height=550');
}


/**
 * Funcion para hacer una llamada ajax
 */
function makeAjaxCall(url, parametros, funcionCambioFase, callType)
   {
       url = url + '?' + parametros;
       //Ajax
       if (window.XMLHttpRequest){ // Non-IE browsers
         objAsyncRequest = new XMLHttpRequest();
         objAsyncRequest.onreadystatechange = funcionCambioFase;
           try {
             objAsyncRequest.open(callType, url, true); //was get
           } catch (e) {
             alert("Cannot connect to server");
           }
         objAsyncRequest.send(null);
       } else if (window.ActiveXObject) { // IE
         objAsyncRequest = new ActiveXObject("Microsoft.XMLHTTP");
         if (objAsyncRequest) {
           objAsyncRequest.onreadystatechange = funcionCambioFase;
           objAsyncRequest.open(callType, url, true);
           objAsyncRequest.send();
         }
       }
   }