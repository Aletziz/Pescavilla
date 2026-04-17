import {AppError} from '../../utils/AppError.js';

const notFound =  (req, res, next) => {
    next(new AppError("Ruta no encontrada", 404));
};

export default notFound;