class Message
{
    constructor(type, message, method)
    {
        this.type = type;
        this.message = message;
        this.method = method;

        this.showMessage();
    }

    showMessage()
    {
        if(this.method === 10)
            return alertbox.show(this.type, this.message);
        else if(this.method === 11)
            return alertboxPersistent.show(this.type, this.message);
    }

}