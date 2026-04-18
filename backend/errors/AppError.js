export class AppError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
        this.isOperational = true;
    }
}
