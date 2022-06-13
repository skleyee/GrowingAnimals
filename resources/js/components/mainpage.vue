<template>
    <div class="container">
        <button @click="openAnimalList" class="create_animal_butt">
        </button>
        <ul ref="animals_list" class="animals_list" :style="{display: this.showPopup}">
            <li v-for="(kind, index) in this.animalKinds" :key="index" :id="kind" class="animals_list__elem" @click="createAnimal"></li>
        </ul>
        <div class="growing_animals">
            <div v-for="(kind, index) in this.animalKinds" :key="index" :ref="'growing_animal_' + kind" :class="'growing_animal_' + kind" class="growing_animal"></div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "mainpage",
        data() {
            return {
                showPopup         : 'none',
                animalKinds       : [],
                disabledButton    : false,
                animalKindsData   : [],
            }
        },
        methods: {
            openAnimalList: function (event) {
                this.showPopup = this.showPopup === 'inline-flex' ? 'none' : 'inline-flex';
            },
            createAnimal: function (event) {
                let elem = event.target;
                if (!elem.classList.contains('disable_button')) {
                    elem.classList.add('disable_button');
                    let animal_kind = elem.id;
                    axios.post('animals', {'name': 'default' + animal_kind, 'kind': animal_kind})
                         .then(response => {
                             this.startGrowing(animal_kind);
                         })
                         .catch(function (error) {
                             console.log(error)
                         });
                }
            },
            startGrowing(animal_kind) {
                let ref_value = 'growing_animal_' + animal_kind;
                let current_animal = this.$refs[ref_value][0];
                current_animal.style.display = 'inline-flex';
                let max_age = 0;
                let max_size = 0;
                let growth_factor = 0
                for (let key in this.animalKindsData) {
                    if (this.animalKindsData[key].kind === animal_kind) {
                        max_age = this.animalKindsData[key].max_age;
                        max_size = this.animalKindsData[key].max_size;
                        growth_factor = this.animalKindsData[key].growth_factor;

                    }
                }
                let start_age = 0;
                let grow = setInterval(() => {
                    if (start_age < max_age) {
                        current_animal.style.width = ((current_animal.clientWidth * (growth_factor < 2 ? 1.08 : growth_factor / 2)) + 'px').toString();
                        current_animal.style.height = ((current_animal.clientHeight * (growth_factor < 2 ? 1.08 : growth_factor / 2)) + 'px').toString();
                        axios.post('/animals/age', {'name': 'default' + animal_kind, 'growth_factor' : growth_factor})
                            .then(response => {
                                start_age++;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                }, growth_factor * 1000)
            }
        },
        beforeMount() {
            axios.get('/truncateAnimalsTable', {}) // Обнуляю таблицу т.к. в тз в запросах не фигурируют айдишники, а без них не сделать возможность существования большого кол-ва записей с одинаковыми именами.
                 .then(response => {})
                 .catch(function (error) {
                     console.log(error)
                 })
        },
        mounted() {
            axios.get('/animal_kinds',{})
                 .then(response => {
                     this.animalKindsData = response.data;
                     this.animalKinds = this.animalKindsData.map(function (elem) {
                         return elem.kind;
                     });
                 })
                 .catch(function (error) {
                     console.log(error);
                 });
        }
    }
</script>

<style scoped>

    .container {
        width: 100vw;
        height: 100vh;

        background-image: url('../../../public/imgs/back.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .create_animal_butt {
        position: relative;

        width: 48px;
        height: 48px;

        margin: 50px 0 0 50px;

        background-image: url('../../../public/imgs/createAnimalButton.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;

        border-radius: 50%;

        cursor: pointer;

        z-index: 5;
    }

    .create_animal_butt:active {
        border-color: #0a53be;
    }

    .animals_list {
        /*display: inline-flex;*/
        display: none;
        position: relative;

        left: -30px;

        width: 236px;
        height: 48px;

        background-image: url('../../../public/imgs/popup.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;

        margin: 0;
        padding: 10px 0 0 0;

        justify-content: flex-end;

        z-index: 3;
    }

    .animals_list__elem {
        display: inline-block;

        position: relative;

        width: 40px;
        height: 40px;

        bottom: 1px;

        cursor: pointer;

        margin: 0;
        padding: 0 0 0 10px;
    }

    .disable_button {
        opacity: 0.2;
        cursor: default;
    }

    #cat {
        background-image: url('../../../public/imgs/cat-logo.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    #hamster {
        background-image: url('../../../public/imgs/hamster-logo.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    #dog {
        background-image: url('../../../public/imgs/dog-logo.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    #pigeon {
        background-image: url('../../../public/imgs/pigeon-logo.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .growing_animals {
        position: relative;

        top: 20%;

        display: flex;

        justify-content: space-around;
    }

    /* max w&h - 650px */

    .growing_animal {
        width: 79px;
        height: 98px;

        display: none;
    }

    .growing_animal_cat {
        background-image: url('../../../public/imgs/cat.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    .growing_animal_dog {
        background-image: url('../../../public/imgs/dog.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    .growing_animal_hamster {
        background-image: url('../../../public/imgs/hamster.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    .growing_animal_pigeon {
        background-image: url('../../../public/imgs/pigeon.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
</style>
