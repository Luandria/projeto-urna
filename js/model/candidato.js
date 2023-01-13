export default class Candidato{
    constructor(nome, descricao, numero, img){
        this.nome = nome
        this.descricao = descricao
        this.numero = numero
        this.img = img
    }

    get nomeCandidato(){
        return this.nome
    }
    get descricaoCandidato(){
        return this.descricao
    }
    get numeroCandidato(){
        return this.numero
    }
}