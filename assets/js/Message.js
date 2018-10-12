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
        if(this.method === 1)
            return alertbox.show(this.type, this.message);
        else
            return alertboxPersistent.show(this.type, this.message);
    }

}