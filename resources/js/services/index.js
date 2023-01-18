import { CommandService } from "./Command";
import { DashboardService } from "./Dashboard";
import { ProductService } from "./Product";

export default function factoryApi(object) {
    if ('dashboard' === object) {
        return new DashboardService();
    } else if ('product' === object) {
        return new ProductService();
    } else if ('command' === object) {
        return new CommandService();
    } else {
        new Error('Object not found');
    }
}