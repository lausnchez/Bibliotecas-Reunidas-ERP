import { ResultSetHeader, RowDataPacket } from "mysql2";
import pool_conexiones from "../database/ConnectionPool";

export class Autor{
    private _id?:number|undefined; // Puede ser opcional
    private _nombre:string;
    private _apellidos:string;

    constructor(nombre:string, apellidos:string, id?:number){
        this._id = id;
        this._nombre = nombre;
        this._apellidos = apellidos;
    }

    // Getters & Setters
    // -------------------------------------------------

    get id():number|undefined{return this._id;}
    get nombre():string{return this._nombre;}
    get apellidos():string{return this._apellidos;}

    set id(id:number){this._id = id;}
    set nombre(nombre:string){this._nombre=nombre;}
    set apellidos(apellidos:string){this._apellidos=apellidos;}

    // Métodos de la base de datos
    // -------------------------------------------------
        
    /**
     * Recoge todos los autores de la base de datos
     */
    static async buscarTodos(): Promise<Autor[]>{
        const query = 'SELECT * FROM autores';
        const [rows] = await pool_conexiones.execute<RowDataPacket[]>(query);

        let autores = rows.map(row => new Autor(
            row.nombre,
            row.apellidos,
            row.id
        ));

        return autores;
    }

    /**
     * Devuelve un autor buscando por su ID
     * @param idAutor 
     * @returns 
     */
    static async buscarPorID(idAutor:number): Promise<Autor | null>{
        const query = 'SELECT * FROM autores WHERE id = ?';
        const [rows] = await pool_conexiones.execute<RowDataPacket[]>(query, [idAutor]);

        // Si no devuelve resultados
        if (rows.length == 0) return null;

        // Formatear y devolver resultados
        let result = rows[0];
        return new Autor(
            result.nombre,
            result.apellidos,
            result.id
        );
    }


    /**
     * Inserta un objeto dentro de la base de datos
     */
    async crearBD(){
        let query = 'INSERT INTO autores(nombre, apellidos) VALUES (?, ?)';
        const [result] = await pool_conexiones.execute<ResultSetHeader>(query, [this.nombre, this.apellidos]);
        this.id = result.insertId;
    }

    /**
     * Actualiza un objeto dentro de la base de datos
     */
    async actualizarBD(){
        if (!this.id) throw new Error("No se puede actualizar un autor sin ID");

        let query = 'UPDATE autores SET nombre = ?, apellidos = ? WHERE id = ?';
        await pool_conexiones.execute(query, [this.nombre, this.apellidos, this.id]);
    }

    /**
     * Eliminar un objeto de una base de datos
     */
    async eliminarBD(){
        // En caso de no contener ID no se podrá borrar de la base de datos
        if(!this.id)return false;

        const query = 'DELETE FROM autores WHERE id = ?';
        const [result] = await pool_conexiones.execute<ResultSetHeader>(query, [this.id]);

        // affectedRows nos dice cuántas filas han sido afectadas por el borrado
        return result.affectedRows > 0;
    }
}