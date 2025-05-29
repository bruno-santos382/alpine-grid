// class Datagrid {
//     constructor(element) {
//         this.el = element;
//         this.colunas = [];
//     }

//     destroy() {
//         console.log('Destroy');
//     }
// }

class Grid {
    constructor(el) {
        this.el = el;
    }

    destroy() {
        console.log('Destroy');
    }
}

export default function(Alpine) {
    Alpine.directive('grid', (el, { expression, value }, { evaluate, cleanup }) => {

        const diretives = {
            'each': () => {
                const rows = [
                    {
                        name: 'name',
                        description: 'description',
                        price: 'price',
                        id: 'id'
                    }
                ]

                rows.forEach((row, index) => {
                    const clone = el.content.cloneNode(true)
                    Alpine.addScopeToNode(clone, { row })
                    el.after(clone)
                    console.log(clone)

                })
            },
            'col': () => {
                console.log('col', )
            },
            'hide': () => {
                console.log('hide', )
            },
            'no-sort': () => {
                console.log('no-sort', )
            }
        }

        if (value !== null) {
            if (value in diretives) {
                diretives[value]();
                return;
            }

            console.error(`Atributo x-grid:${value} é inválido`);
            return;
        }

        const grid = new Grid(el);
        console.log('initialize grid')
        cleanup(() => grid.destroy());
    });
}
