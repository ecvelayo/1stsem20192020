import React from 'react';
import {
    Container,
    Form,
    FormGroup,
    Input,
    Button,
    Row,
    Col,
    Label
} from 'reactstrap';
import Axios from 'axios';
import QuestionCard from './QuestionCard';
import ArrowBackIcon from '@material-ui/icons/ArrowBack';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import PageNotFound from './PageNotFound';

export default class Test extends React.Component {
    state = {
        questions: [],
        question: '',
        correct: '',
        answer1: '',
        answer2: '',
        answer3: '',
        errors: [],
        passing: 0,
        notFound: false
    };
    componentDidMount = () => {
        let { test, lecture } = this.props.match.params;
        Axios.get(`/api/test/${test}`)
            .then(response => {
                let items = response.data;

                // let shuffle = JSON.parse(data[0].answers);
                // shuffle = this.shuffle(shuffle);
                // data[0].answers = shuffle;

                // let shuffle = items.map(item => {
                //     let answers = JSON.parse(item.answers);
                //     answers = this.shuffle(answers);
                //     item.answers = answers;
                //     return item;
                // });
                // this.setState({
                //     questions: shuffle
                // });

                // console.log(response.data);
                this.setState({
                    questions: items
                });
            })
            .catch(error => {
                if (error.response.status === 404) {
                    this.setState({
                        notFound: true
                    });
                }
                console.log(error.response.data);
            });
        Axios.get(`/api/test/${lecture}/passing`)
            .then(({ data }) => {
                this.setState({
                    passing: data
                });
            })
            .catch(error => {
                if (error.response.status === 404) {
                    this.setState({
                        notFound: true
                    });
                }
                console.log(error.response.data);
            });
    };
    shuffle = array => {
        var currentIndex = array.length,
            temporaryValue,
            randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {
            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    };
    handleFieldChange = event => {
        this.setState({
            [event.target.name]: event.target.value
        });
    };
    handleSubmit = event => {
        event.preventDefault();
        let { test } = this.props.match.params;
        let answers = [
            this.state.correct,
            this.state.answer1,
            this.state.answer2,
            this.state.answer3
        ];
        let data = {
            test_id: test,
            question: this.state.question,
            correct: this.state.correct,
            options: answers
        };
        Axios.post(`/api/test`, data)
            .then(response => {
                if (response.data) {
                    this.setState({
                        questions: response.data,
                        question: '',
                        correct: '',
                        answer1: '',
                        answer2: '',
                        answer3: '',
                        errors: []
                    });
                }
                document.getElementById('question').focus();
            })
            .catch(error =>
                this.setState({
                    errors: error.response.data.errors
                })
            );
    };
    goBack = () => {
        let { history } = this.props;
        let { section, training } = this.props.match.params;
        history.push(`/edit/training/${training}/section/${section}`);
    };
    clearErrors = () => {
        this.setState({
            errors: []
        });
    };
    handlePassingRate = event => {
        const { test } = this.props.match.params;
        const data = {
            passing: event.target.value
        };
        Axios.put(`/api/test/${test}/passing`, data).then(({ data }) => {
            this.setState({
                passing: data
            });
        });
    };
    render() {
        if (this.state.notFound) {
            return <PageNotFound />;
        }
        let { questions } = this.state;
        let { errors } = this.state;
        return (
            <Container>
                <div>
                    <Button
                        color='light'
                        onClick={this.goBack}
                        className='mb-3'>
                        <ArrowBackIcon fontSize='small' /> Back to section
                    </Button>
                </div>
                <Row>
                    <Col lg={6}>
                        {Object.keys(errors).length > 0 ? (
                            <ErrorBag
                                error={Object.keys(errors).length}
                                clearErrors={this.clearErrors}
                            />
                        ) : (
                            ''
                        )}
                        <h5>Create a question</h5>
                        <Form onSubmit={this.handleSubmit}>
                            <FormGroup>
                                {/* <textarea name="question" id="question" cols="30" rows="3" 
								value={this.state.question}
								onChange={this.handleFieldChange}
								placeholder='Question'
								ref={i => {i && i.focus()}}
								className='form-control'></textarea> */}
                                <Input
                                    type='textarea'
                                    name='question'
                                    id='question'
                                    value={this.state.question}
                                    onChange={this.handleFieldChange}
                                    placeholder='Question'
                                    autoFocus
                                    required
                                />
                                {/* <input type="text" className="form-control"
								value={this.state.question}
								onChange={this.handleFieldChange}
								placeholder='Question'
								ref={i => {this.inputRef = i}}
								/> */}
                            </FormGroup>
                            <FormGroup>
                                <Input
                                    type='text'
                                    name='correct'
                                    value={this.state.correct}
                                    onChange={this.handleFieldChange}
                                    placeholder='Correct answer'
                                    required
                                />
                            </FormGroup>
                            <div className='mt-4'>
                                <h6>Other answers</h6>
                                <FormGroup>
                                    <Input
                                        type='text'
                                        name='answer1'
                                        value={this.state.answer1}
                                        onChange={this.handleFieldChange}
                                        required
                                    />
                                </FormGroup>
                                <FormGroup>
                                    <Input
                                        type='text'
                                        name='answer2'
                                        value={this.state.answer2}
                                        onChange={this.handleFieldChange}
                                        required
                                    />
                                </FormGroup>
                                <FormGroup>
                                    <Input
                                        type='text'
                                        name='answer3'
                                        value={this.state.answer3}
                                        onChange={this.handleFieldChange}
                                        required
                                    />
                                </FormGroup>
                            </div>
                            <Button color='primary' type='submit'>
                                Add
                            </Button>
                        </Form>
                    </Col>
                    <Col>
                        <div className='d-flex flex-row justify-content-between align-items-center'>
                            <div>
                                <h5>Questions</h5>
                            </div>
                            <FormGroup
                                row
                                className='d-flex align-items-center mb-0'>
                                <Label for='passing'>Passing Rate</Label>
                                <Col>
                                    <Input
                                        type='select'
                                        name='passing'
                                        id='passing'
                                        value={this.state.passing}
                                        onChange={this.handlePassingRate}>
                                        <option value={50}>50%</option>
                                        <option value={60}>60%</option>
                                        <option value={70}>70%</option>
                                        <option value={80}>80%</option>
                                        <option value={90}>90%</option>
                                        <option value={100}>100%</option>
                                    </Input>
                                </Col>
                            </FormGroup>
                        </div>

                        <Questions questions={questions} />
                    </Col>
                </Row>
            </Container>
        );
    }
}

const Questions = props => {
    let { questions } = props;
    const items = questions.map(question => {
        let { answers, correct } = question;
        return (
            // <div className='bg-info p-3 my-2' key={question.id}>
            //     <div className='d-flex flex-column'>
            //         <div>{question.question}</div>
            //         <div className='bg-warning'>
            //             <AnswerItems answers={answers} correct={correct} />
            //         </div>
            //     </div>
            // </div>
            <QuestionCard
                key={question.id}
                question={question.question}
                correct={correct}
            />
        );
    });
    return (
        <div
            className='my-3 overflow-auto pr-1'
            style={{ height: 'calc(100vh - 182px)' }}>
            {items}
        </div>
    );
};

const AnswerItems = props => {
    let { answers } = props;
    answers = JSON.parse(answers);
    const options = answers.map((answer, i) => {
        if (answer === props.correct) {
            return (
                <div className='bg-success' key={i}>
                    {answer}
                </div>
            );
        } else {
            return <div key={i}>{answer}</div>;
        }
    });
    return <div>{options}</div>;
};

const ErrorBag = props => (
    <div className='d-flex flex-row justify-content-between bg-danger text-white mb-3 p-3 rounded shadow'>
        {/* {props.error} fields have duplicate answers */}
        <div>Must not have duplicate answers</div>
        <div>
            <CloseRoundedIcon
                fontSize='small'
                onClick={props.clearErrors}
                style={{ cursor: 'pointer' }}
            />
        </div>
    </div>
);
