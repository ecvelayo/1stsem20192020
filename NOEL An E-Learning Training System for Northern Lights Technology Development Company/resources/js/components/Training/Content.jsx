import React, { useState, useEffect } from 'react';
import { Container, Button } from 'reactstrap';
import getBlockStyle from '../Editor/GetBlockStyle';
import styleMap from '../Editor/StyleMap';
import { EditorState, convertFromRaw } from 'draft-js';
import Axios from 'axios';
import TopicTestComponent from './TopicTestComponent';
import { makeStyles } from '@material-ui/core/styles';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import Paper from '@material-ui/core/Paper';
import { green, deepOrange } from '@material-ui/core/colors';
import DoneRoundedIcon from '@material-ui/icons/DoneRounded';

import Editor, { composeDecorators } from 'draft-js-plugins-editor';
import createAlignmentPlugin from 'draft-js-alignment-plugin';
import createResizeablePlugin from 'draft-js-resizeable-plugin';
import createBlockDndPlugin from 'draft-js-drag-n-drop-plugin';
import createImagePlugin from 'draft-js-image-plugin';

const resizeablePlugin = createResizeablePlugin();
const blockDndPlugin = createBlockDndPlugin();
const alignmentPlugin = createAlignmentPlugin();

const decorator = composeDecorators(
    resizeablePlugin.decorator,
    alignmentPlugin.decorator,
    blockDndPlugin.decorator
);
const imagePlugin = createImagePlugin({ decorator });

const plugins = [
    blockDndPlugin,
    alignmentPlugin,
    resizeablePlugin,
    imagePlugin
];


const useStyles = makeStyles(theme => ({
	paper: {
		padding: theme.spacing(3, 2)
	},
	formControl: {
		margin: theme.spacing(3),
		marginLeft: theme.spacing(4)
	},
	formControlLabel: {
		marginBottom: '0!important'
	},
	correct: {
		background: green[50]
	},
	wrong: {
		background: deepOrange[50]
	},
	isCorrect: {
		color: green[600],
		position: 'absolute',
		top: '8px',
		left: '-30px'
	}
}));

export default function Content({
	lecture,
	lecture: { content },
	children,
	enrolledId,
	checkTest,
	ref
}) {
	const classes = useStyles();
	const [editorState, setEditorState] = useState(EditorState.createEmpty());
	const [isCheck, setIsCheck] = useState(false);
	const [retake, setRetake] = useState(false);
	const [questions, setQuestions] = useState([]);
	const [value, setValue] = React.useState({});
	const [passing, setPassing] = React.useState(0);
	const [result, setResult] = React.useState({});

	const handleChange = (event, id) => {
		setValue({
			...value,
			[id]: {
				id: id,
				answer: event.target.value
			}
		});
	};
	const handleCheck = checks => {
		if (Object.keys(value).length < questions.length) {
			if (
				confirm(
					'Some questions are still unanswered, proceed checking your answers anyway?'
				)
			) {
				setIsCheck(true);
				checkAnswers(checks);
			}
		} else {
			setIsCheck(true);
			checkAnswers(checks);
		}
	};
	const checkAnswers = () => {
		let ans = [];
		let correct = 0;
		Object.keys(value).forEach(key => {
			ans.push(value[key]);
			questions.find(question => {
				if (question.id === value[key].id) {
					value[key].answer === question.correct ? correct++ : null;
				}
			});
		});
		let userAns = {
			enrolled_id: enrolledId,
			lecture_id: lecture.id,
			answer: ans,
			correct: correct
		};
		console.log(userAns, 'check answers');
		const grade = computeScore(correct);
		if (grade >= passing) {
			setResult({
				score: correct,
				total: questions.length,
				rate: grade,
				passed: true
			});
			checkTest(false);
			Axios.post('/api/submit/answer', userAns)
				.then(response => {
					console.log(response, 'check answers');
				})
				.catch(response => {
					console.log(response);
				});
		} else {
			let data ={
				enrolled_trainings_id: enrolledId
			}
			Axios.post('/api/submit/failed', data);
			setResult({
				score: correct,
				total: questions.length,
				rate: grade,
				passed: false
			});
			setRetake(true);
		}
	};
	const computeScore = score => {
		const total = questions.length;
		const grade = (score / total) * 100;
		return grade.toFixed(2);
	};
	const getUserScore = (score, total, passing) => {
		const grade = (score / total) * 100;
		const passed = grade >= passing ? true : false;
		setResult({
			score: score,
			total: total,
			rate: grade.toFixed(2),
			passed: passed
		});
	};
	if (!lecture.isTest) {
		useEffect(() => {
			setEditorState(
				content === null
					? EditorState.createEmpty()
					: EditorState.createWithContent(convertFromRaw(JSON.parse(content)))
			);
			checkTest(false);
		}, [lecture.id]);
	} else {
		useEffect(() => {
			const fetchData = async () => {
				const result = await Axios.get(`/api/lecture/${lecture.id}/test`).catch(
					error => console.log(error.response)
				);
				const passing = await Axios.get(`/api/test/${lecture.id}/passing`);
				const getAnswers = await Axios.get(
					`/api/answers/enrolled/${enrolledId}/lecture/${lecture.id}`
				);
				Axios.get(
					`/api/test/enrolled/${enrolledId}/lecture/${lecture.id}/checked`
				).then(response => {
					// Get the score of the user
					getUserScore(response.data.score, result.data.length, passing.data);
				});

				if (Object.entries(getAnswers.data).length !== 0) {
					let { data } = getAnswers;
					let newVal = {};
					data.map(item => {
						newVal = {
							...newVal,
							[item.question_id]: {
								id: item.question_id,
								answer: item.answer
							}
						};
					});
					setValue(newVal);
					setIsCheck(true);
					checkTest(false);
				} else {
					checkTest(true);
					setIsCheck(false);
				}
				setPassing(passing.data);
				setQuestions(result.data);
			};
			fetchData();
		}, [lecture.id]);
	}
	const ContentBody = () => {
		if (!lecture.isTest) {
			return (
				<div
					className='RichEditor-root'
					style={{ border: 0, paddingTop: 0, paddingBottom: 0 }}
				>
					<div className='RichEditor-editor' style={{ border: 0, margin: 0 }}>
						<Editor
							blockStyleFn={getBlockStyle}
							customStyleMap={styleMap}
							editorState={editorState}
							plugins={plugins}
							readOnly
						/>
					</div>
				</div>
			);
		} else {
			const items =
				questions.length > 0
					? questions.map(question => {
							let { answers } = question;
							let sample;
							Object.keys(value)
								.filter(key => {
									return key == question.id;
								})
								.forEach(k => {
									sample = value[k].answer;
								});
							answers = JSON.parse(answers);
							let OptionItems = () => {
								let choices = answers.map((option, index) => {
									if (isCheck) {
										return (
											<div key={index} className='position-relative'>
												{question.correct === option ? (
													<DoneRoundedIcon className={classes.isCorrect} />
												) : null}
												<FormControlLabel
													className={classes.formControlLabel}
													value={option}
													control={<Radio color='primary' />}
													label={option}
													disabled={true}
												/>
											</div>
										);
									} else {
										return (
											<div key={index}>
												<FormControlLabel
													className={classes.formControlLabel}
													value={option}
													control={<Radio color='primary' />}
													label={option}
												/>
											</div>
										);
									}
								});
								return choices;
							};
							return (
								<div key={question.id} className='my-2'>
									<Paper
										className={`${classes.paper} ${
											isCheck
												? sample === question.correct
													? classes.correct
													: null
												: null
										}`}
									>
										<FormControl
											component='fieldset'
											className={classes.formControl}
										>
											<FormLabel component='legend'>
												{question.question}
											</FormLabel>
											<RadioGroup
												aria-label='options'
												name={`${question.id}`}
												value={sample}
												onChange={event => {
													handleChange(event, question.id);
												}}
											>
												<OptionItems />
											</RadioGroup>
										</FormControl>
									</Paper>
								</div>
							);
					  })
					: 'No questions';
			return (
				<div>
					<div>{items}</div>
					<div className='d-flex flex-row justify-content-between align-items-center mt-4 '>
						<div className='h6'>Passing rate: {passing}%</div>
						<div>
							{retake ? (
								<Button
									color='success'
									onClick={() => {
										setValue({});
										setRetake(false);
										setIsCheck(false);
										location.reload(true);
									}}
								>
									Retake
								</Button>
							) : (
								<Button
									color='success'
									onClick={() => handleCheck()}
									disabled={isCheck}
								>
									Check answers
								</Button>
							)}
						</div>
					</div>
					{isCheck ? (
						<div className='h6'>
							Score: {result.score}/{result.total} ({result.rate}%) ={' '}
							{result.passed ? (
								<span className='font-weight-bold text-success'>PASSED</span>
							) : (
								<span className='font-weight-bold text-muted'>FAILED</span>
							)}
						</div>
					) : null}
				</div>
			);
		}
	};
	return (
		<>
			<Container className='pb-5'>
				<div className='display-3 font-weight-bold mt-3 mb-5'>
					{lecture.title}
				</div>
				<ContentBody />
			</Container>
			{children}
		</>
	);
}
