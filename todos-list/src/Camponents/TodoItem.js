import React from 'react';

export default function TodoItem({ todo , onDelete }) {
  return (
    <div className="bg-secondary border py-2 px-4 rounded d-flex justify-content-between align-items-center my-2">
      <div>
        <h4 className='text-white'>{todo.title}</h4>
        <p className='text-white'>{todo.desc}</p>
      </div>
      <div>
        <button className="btn btn-sm btn-danger" onClick={() =>{onDelete(todo)}}>Delete</button>
      </div>
    </div>
  );
}
