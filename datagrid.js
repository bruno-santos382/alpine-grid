class Datagrid {
    constructor(element) {
        this.el = element;
        this.colunas = [];
    }

    destroy() {
        console.log('Destroy');
    }
}



export default function (Alpine) {
    Alpine.directive('grid', (el, { expression, value }, { cleanup }) => {

        if (value == null) {
            const grid = new Datagrid(el);
            console.log('initialize grid')
            cleanup(() => grid.destroy());
        }
    });
}
