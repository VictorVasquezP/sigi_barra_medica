import { DashboardService } from "./Dashboard";

export default function factoryApi(object) {
    if ('dashboard' === object) {
        return new DashboardService();
    } else {
        new Error('Object not found');
    }
}