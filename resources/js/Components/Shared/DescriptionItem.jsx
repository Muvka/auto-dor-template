import React from 'react';
import clsx from 'clsx';

const DescriptionItem = (
	{
		children = null,
		term = '',
		definition = '',
		className = '',
	},
) => {
	let definitionContent = null;

	if (!definition !== '') {
		if (Array.isArray(definition)) {
			definitionContent = (
				<ul className='description-list__sub-list'>
					{definition.map((string, index) => (
						<li key={index.toString()} className='description-list__text'>{string}</li>
					))}
				</ul>
			);
		} else if (typeof definition === 'string' || typeof definition === 'number') {
			definitionContent = <p className='description-list__text'>{definition}</p>;
		}
	}

	return (
		<div className={clsx('description-list__item', className)}>
			<dt className='description-list__term'>{term}</dt>
			<dd className='description-list__definition'>
				{definitionContent}
				{Boolean(children) && (
					<div className='description-list__content-container'>
						{children}
					</div>
				)}
			</dd>
		</div>
	);
};

export default DescriptionItem;
