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
        return alertbox.show(this.type, this.message);
    }

}