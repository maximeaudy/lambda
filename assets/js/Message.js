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
      console.log(this.message);
    }
}