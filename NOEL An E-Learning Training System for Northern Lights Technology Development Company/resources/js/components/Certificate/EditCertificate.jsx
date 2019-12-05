import React from 'react';
import { PDFExport, savePDF } from '@progress/kendo-react-pdf';
import styled from 'styled-components';
import Axios from 'axios';
import { Container, Input, Row, Col, Modal, ModalBody } from 'reactstrap';
import PanoramaRoundedIcon from '@material-ui/icons/PanoramaRounded';
import LinearProgress from '@material-ui/core/LinearProgress';
import VisibilityRoundedIcon from '@material-ui/icons/VisibilityRounded';
import VisibilityOffRoundedIcon from '@material-ui/icons/VisibilityOffRounded';
import Authenticate from '../Auth/Authenticate';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import IconButton from '@material-ui/core/IconButton';

// A4
// width: 595px;
// height: 420px;

// Letter
// height: 792px;
// width: 612px;

export default class EditCertificate extends React.Component {
    pdfExportComponent;
    state = {
        training: {},
        HRs: [],
        admins: [],
        admin: '',
        hr: '',
        background: null,
        hidden: false,
        errors: [],
        progress: 0,
        modal: false
    };

    componentDidMount = async () => {
        const { id } = this.props.match.params;
        const result = await Axios.get(`/api/training/${id}`);
        const hrs = await Axios.get(`/api/get/hrs`);
        const admins = await Axios.get(`/api/get/admins`);
        const cert = await Axios.get(`/api/get/certificate/${id}`);
        Authenticate.getCurrentUser(user => {
            if (user.isHR) {
                this.setState({
                    training: result.data,
                    HRs: hrs.data,
                    admins: admins.data,
                    hr: `${user.fname} ${user.lname}`,
                    admin: cert.data.admin,
                    background: cert.data.background
                });
            } else if (user.isAdmin) {
                this.setState({
                    training: result.data,
                    HRs: hrs.data,
                    admins: admins.data,
                    admin: `${user.fname} ${user.lname}`,
                    hr: cert.data.hr,
                    background: cert.data.background
                });
            } else {
                this.props.history.push('/');
            }
        });
    };

    toggle = () => {
        this.setState(prevState => ({
            modal: !prevState.modal,
            progress: 0
        }));
    };

    handleChange = (event, hasFile) => {
        if (hasFile) {
            let image = event.target.files[0];
            console.log(image);
            if (image.size > 4000000) {
                let uploadError = {
                    background: ['The image file must not be greater than 4 MB']
                };
                this.setState({
                    errors: uploadError
                });
            } else {
                let certificate = new FormData();
                certificate.append('background', image, image.name);
                Axios.post(
                    `/api/add/certificate/image/${this.state.training.id}`,
                    certificate,
                    {
                        onUploadProgress: progressEvent => {
                            let progress = Math.round(
                                (progressEvent.loaded / progressEvent.total) *
                                    100
                            );
                            this.setState({
                                modal: true,
                                progress: progress
                            });
                        }
                    }
                )
                    .then(response => {
                        this.setState({
                            admin: response.data.admin,
                            hr: response.data.hr,
                            background: response.data.background
                        });
                        this.toggle();
                    })
                    .catch(error => {
                        this.setState({
                            modal: false,
                            progress: 0,
                            errors: error.response.data.errors
                        });
                        console.log(error);
                    });
            }
        } else {
            let data = {
                [event.target.name]: event.target.value
            };
            Axios.put(
                `/api/update/certificate/${this.state.training.id}`,
                data
            ).then(response => {
                this.setState({
                    admin: response.data.admin,
                    hr: response.data.hr,
                    background: response.data.background
                });
            });
        }
    };

    hasErrorFor = field => {
        return !!this.state.errors[field];
    };

    renderErrorFor = field => {
        if (this.hasErrorFor(field)) {
            return (
                <div className='d-flex flex-row bg-danger justify-content-between align-items-center h6 rounded shadow-sm text-white p-3 my-2 mb-3'>
                    <div>{this.state.errors[field][0]}</div>
                    <div>
                        <IconButton
                            size='small'
                            onClick={() => {
                                this.setState({
                                    errors: []
                                });
                            }}
                            color='inherit'>
                            <CloseRoundedIcon fontSize='inherit' />
                        </IconButton>
                    </div>
                </div>
            );
        }
    };

    render() {
        const { HRs, admins } = this.state;
        const HRList = HRs.map(hr => (
            <option
                key={hr.id}
                value={`${hr.fname} ${hr.lname}`}>{`${hr.fname} ${hr.lname}`}</option>
        ));
        const adminList = admins.map(admin => (
            <option
                key={admin.id}
                value={`${admin.fname} ${admin.lname}`}>{`${admin.fname} ${admin.lname}`}</option>
        ));
        return (
            <>
                <Modal
                    isOpen={this.state.modal}
                    backdrop='static'
                    centered={true}>
                    <ModalBody>
                        <LinearProgress
                            color='primary'
                            variant='determinate'
                            value={this.state.progress}></LinearProgress>
                        <div className='text-center'>
                            <h5>Uploading</h5>
                        </div>
                    </ModalBody>
                </Modal>
                <Container className='mb-4'>
                    {this.hasErrorFor('background')
                        ? this.renderErrorFor('background')
                        : null}
                    <Row form>
                        <div className='col-md form-group'>
                            <label htmlFor='hr'>HR</label>
                            <Input
                                type='select'
                                name='hr'
                                id='hr'
                                onChange={this.handleChange}
                                value={this.state.hr}>
                                {HRList}
                            </Input>
                        </div>
                        <div className='col-md form-group'>
                            <label htmlFor='admin'>General Manager</label>
                            <Input
                                type='select'
                                name='admin'
                                id='admin'
                                onChange={this.handleChange}
                                value={this.state.admin}>
                                {adminList}
                            </Input>
                        </div>
                        <div className='col col-md-12 col-lg form-group'>
                            <Input
                                type='file'
                                name='background'
                                id='background'
                                onChange={event =>
                                    this.handleChange(event, true)
                                }
                                style={{ display: 'none' }}
                            />
                            <div className='d-flex flex-column'>
                                <div>
                                    <label htmlFor='hr'>
                                        Certificate background
                                    </label>
                                </div>
                                <div>
                                    <button
                                        className='btn btn-light btn-block border'
                                        onClick={() => {
                                            document
                                                .getElementById('background')
                                                .click();
                                        }}>
                                        <PanoramaRoundedIcon className='mr-2' />
                                        Select an image
                                    </button>
                                </div>
                            </div>
                        </div>
                    </Row>
                    {/* <Row>
                        <Col>
                            <button
                                className='btn btn-primary mb-4'
                                onClick={this.handleSubmit}
                            >
                                Save Certificate
                            </button>
                        </Col>
                    </Row> */}
                    <div className='d-flex justify-content-end bg-secondary border mx-auto p-3'>
                        <button
                            className='btn btn-outline-light mx-2'
                            onClick={() => {
                                this.pdfExportComponent.save();
                            }}>
                            Export Sample PDF
                        </button>
                    </div>
                    <Preview>
                        <PDFExport
                            paperSize={'Letter'}
                            fileName='training.pdf'
                            landscape={true}
                            imageResolution={72}
                            ref={c => (this.pdfExportComponent = c)}>
                            <MainContainer data={this.state} />
                        </PDFExport>
                    </Preview>
                </Container>
            </>
        );
    }
}

export const MainContainer = ({ data }) => {
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    const dateCompleted = new Date(data.date_completed);
    // background-image: url('/storage/certificate/template.jpg');
    const bg = `url('/storage/certificate/${
        data.background ? data.background : `template.jpg`
    }');`;
    // background-image: url('/storage/certificate/${data =>
    //     data.background ? data.background : `template.jpg`}');
    const BGContainer = styled.div`
        background-image: ${bg};
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        flex-direction: column !important;
        display: flex !important;
        padding: 3rem 1.5rem;
    `;
    return (
        <TemplateContainer>
            <BGContainer>
                <CompanyName>
                    Northern Lights Technology Development Philippines Corp
                </CompanyName>
                <div className='mb-2'>
                    <p>present this</p>
                    <TitleContainer>Certificate of Completion</TitleContainer>
                    to
                </div>
                <UserName>
                    {data.user !== undefined ? data.user : 'User Name'}
                </UserName>
                <MessageContainer className='h5'>
                    For having completed the training:{' '}
                    <div className='font-weight-bold'>
                        {data.training.title}
                    </div>
                    on{' '}
                    <div className='font-weight-bold'>
                        {data.date_completed !== undefined
                            ? dateCompleted.toLocaleDateString('en-US', options)
                            : 'Date completed'}
                    </div>
                </MessageContainer>
                <div className='d-flex justify-content-around mx-5 flex-row mt-auto'>
                    <div>
                        <StyledRule />
                        <ManagerNames>{data.hr}</ManagerNames>
                        <h6 className='font-italic'>
                            HR & Admin Office/Trainer
                        </h6>
                    </div>
                    <div>
                        <StyledRule />
                        <ManagerNames>{data.admin}</ManagerNames>
                        <h6 className='font-italic'>General Manager</h6>
                    </div>
                </div>
            </BGContainer>
        </TemplateContainer>
    );
};

// const StyledToast = styled(ToastContainer)``;

const Preview = styled.div`
    overflow: auto;
    width: 100%;
    height: 500px;
    background: #e0e0e0;
    padding: 1.25rem;
`;

const TemplateContainer = styled.div`
    width: 792px;
    height: 612px;
    margin: auto;
    background-color: white;
    text-align: center;
    outline: 1px solid rgba(0, 0, 0, 0.3);
`;

const StyledRule = styled.hr`
    border-top: 3px solid rgba(0, 0, 0, 1);
    width: 200px;
`;

const CompanyName = styled.h3`
    font-family: serif;
    margin-bottom: 1rem;
`;

const UserName = styled.h1`
    font-family: sans-serif;
    margin-bottom: 1rem;
    font-weight: bolder;
    text-transform: uppercase !important;
`;

const MessageContainer = styled.div`
    align-self: center !important;
    font-family: sans-serif;
`;

const TitleContainer = styled.h2`
    font-family: auto;
    font-weight: bold;
    text-transform: uppercase !important;
`;

const ManagerNames = styled.h4`
    text-transform: uppercase !important;
`;
