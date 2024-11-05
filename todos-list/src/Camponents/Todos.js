import React from 'react';
import TodoItem from './TodoItem';

export default function Todos(props) {
  return (
    <div className="container todos">
      <h2 className="text-center my-3 text-primary">Todo List</h2>
      {props.todos.length === 0 ? (
        <div className="alert alert-danger" role="alert">
          No Todos Found!
        </div>
      ) : (
        props.todos.map((todo) => {
          return <TodoItem todo={todo} key={todo.id} onDelete={props.onDelete} />;
        })
      )}
    </div>
  );
}
