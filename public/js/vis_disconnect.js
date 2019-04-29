function Disconnect()
{
    var self = this;
    
    this.reload = function()
    {
        document.location.reload();
    }

    this.disconnect = function() {
        Utils.ajaxGet('/disconnect', self.reload);
    }   

    this.disconnectEvt = function() {
        document.getElementById('disconnect').addEventListener('click', this.disconnect);
    }
}

var disconnect = new Disconnect();
disconnect.disconnectEvt();