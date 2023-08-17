import React from 'react';
import { Link } from '@inertiajs/react';
import clsx from 'clsx';

const QuestionWidget = ({ className = '' }) => {
	return (
		<div className={clsx('question-widget', className)}>
			<p className='title title--small question-widget__title'>У Вас есть вопросы?</p>
			<p className='question-widget__text'>Напишите нам и мы ответим</p>
			<Link href={route('client.maintenance.question.create')} className='button button--accent question-widget__link'>
				Задать вопрос
			</Link>
		</div>
	);
};

export default QuestionWidget;
